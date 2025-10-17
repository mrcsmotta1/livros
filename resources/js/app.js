import "./bootstrap";
import Swal from "sweetalert2";
import Alpine from "alpinejs";
import Inputmask from "inputmask";
import $ from "jquery";
import "select2/dist/css/select2.min.css";
import "select2";

window.Alpine = Alpine;

window.Swal = Swal;

window.$ = $;
window.jQuery = $;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    // === Máscaras de campos ===
    Inputmask({ mask: "9999" }).mask("#ano_publicacao");
    Inputmask({
        alias: "currency",
        prefix: "R$ ",
        groupSeparator: ".",
        radixPoint: ",",
        digits: 2,
        autoGroup: true,
        numericInput: true,
        removeMaskOnSubmit: true,
    }).mask("#valor");

    // ======= Tradução global Select2 para PT-BR =======
    $.fn.select2.defaults.set("language", {
        errorLoading: function () {
            return "Os resultados não puderam ser carregados.";
        },
        inputTooShort: function (args) {
            const remainingChars = args.minimum - args.input.length;
            return `Digite ${remainingChars} ou mais caractere${
                remainingChars === 1 ? "" : "s"
            }`;
        },
        inputTooLong: function (args) {
            const overChars = args.input.length - args.maximum;
            return `Apague ${overChars} caractere${overChars === 1 ? "" : "s"}`;
        },
        loadingMore: function () {
            return "Carregando mais resultados...";
        },
        maximumSelected: function (args) {
            return `Você só pode selecionar ${args.maximum} item${
                args.maximum === 1 ? "" : "s"
            }`;
        },
        noResults: function () {
            return "Nenhum resultado encontrado";
        },
        searching: function () {
            return "Buscando...";
        },
        removeAllItems: function () {
            return "Remover todos os itens";
        },
    });

    function getSelecionados(tipo, $current) {
        const ids = [];
        $(`.${tipo}-select`).each(function () {
            const val = $(this).val();
            if (val && (!$current || this !== $current[0])) {
                ids.push(val);
            }
        });
        return ids;
    }

    // === Inicializadores do Select2 ===
    function inicializarSelectAutor($select) {
        if ($select.hasClass("select2-hidden-accessible")) {
            return;
        }

        $select
            .select2({
                placeholder: "Digite para buscar autor...",
                ajax: {
                    url: "/api/autores/search",
                    dataType: "json",
                    delay: 250,
                    cache: false,
                    data: (params) => ({
                        q: params.term,
                        exclude: getSelecionados("autor", $select),
                    }),
                    processResults: (data) => ({
                        results: data.map((item) => ({
                            id: item.id,
                            text: item.nome,
                        })),
                    }),
                },
                minimumInputLength: 1,
            })
            .on("change", function () {
                atualizarBotao("autor");
            });
    }

    function inicializarSelectAssunto($select) {
        if ($select.hasClass("select2-hidden-accessible")) {
            return;
        }

        $select
            .select2({
                placeholder: "Digite para buscar assunto...",
                ajax: {
                    url: "/api/assuntos/search",
                    dataType: "json",
                    delay: 250,
                    cache: false,
                    data: (params) => ({
                        q: params.term,
                        exclude: getSelecionados("assunto", $select),
                    }),
                    processResults: (data) => ({
                        results: data.map((item) => ({
                            id: item.id,
                            text: item.descricao,
                        })),
                    }),
                },
                minimumInputLength: 1,
            })
            .on("change", function () {
                atualizarBotao("assunto");
            });
    }

    // === Inicializador do Select2 de Editora (single) ===
    function inicializarSelectEditora($select) {
        if ($select.hasClass("select2-hidden-accessible")) {
            return;
        }

        $select
            .select2({
                width: "100%",
                placeholder: "Digite para buscar editora...",
                allowClear: false, // removemos o 'x' pequeno do Select2; usaremos o botão vermelho externo
                ajax: {
                    url: "/api/editoras/search",
                    dataType: "json",
                    delay: 250,
                    cache: false,
                    data: (params) => ({
                        q: params.term,
                        // não retornar a que já está selecionada
                        exclude: (() => {
                            const v = $select.val();
                            return v ? [String(v)] : [];
                        })(),
                    }),
                    processResults: (data) => ({ results: data }),
                },
                minimumInputLength: 1,
            })
            .on("change", function () {
                const temValor = !!$(this).val();
                $(this)
                    .closest(".input-group")
                    .find(".remove-editora")
                    .toggle(temValor);
            });
    }

    //retornar os autores e assuntos ja iseridos em create e edit livro após um retorno do validate
    const autoresAntigos = window.livroOld?.autores || [];
    const assuntosAntigos = window.livroOld?.assuntos || [];

    // Garante que exista pelo menos um campo de cada tipo
    if ($(".autor-field").length === 0) {
        const $campo = $(
            `<div class="input-group mb-2 autor-field">
                <select name="autores[]" class="form-select autor-select"></select>
                <button type="button" class="btn btn-danger remove-autor" style="display:none">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>`
        );
        $("#autores-container").append($campo);
        inicializarSelectAutor($campo.find(".autor-select"));
    }

    if ($(".assunto-field").length === 0) {
        const $campo = $(
            `<div class="input-group mb-2 assunto-field">
                <select name="assuntos[]" class="form-select assunto-select"></select>
                <button type="button" class="btn btn-danger remove-assunto" style="display:none">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>`
        );
        $("#assuntos-container").append($campo);
        inicializarSelectAssunto($campo.find(".assunto-select"));
    }

    // 🔹 Pega IDs já existentes no HTML (ex: vindos do edit)
    const autoresExistentes = $(".autor-select")
        .map(function () {
            return $(this).data("selected") || $(this).val();
        })
        .get();

    const assuntosExistentes = $(".assunto-select")
        .map(function () {
            return $(this).data("selected") || $(this).val();
        })
        .get();

    //Normaliza tudo para string e filtra apenas os que ainda não existem (evita '1' vs 1)
    const autoresExistentesStr = autoresExistentes.map((x) => String(x));
    const assuntosExistentesStr = assuntosExistentes.map((x) => String(x));
    const autoresAntigosStr = autoresAntigos.map((x) => String(x));
    const assuntosAntigosStr = assuntosAntigos.map((x) => String(x));

    const novosAutores = autoresAntigosStr.filter(
        (id) => !autoresExistentesStr.includes(id)
    );
    const novosAssuntos = assuntosAntigosStr.filter(
        (id) => !assuntosExistentesStr.includes(id)
    );

    // === AUTORES ===
    if (novosAutores.length > 0) {
        const $primeiroCampoAutor = $(".autor-field").first();
        const $primeiroSelectAutor = $primeiroCampoAutor.find(".autor-select");
        const temValorPrimeiro =
            $primeiroSelectAutor.val() || $primeiroSelectAutor.data("selected");

        // Usa a primeira linha existente para o primeiro valor (sem botão remover)
        if (!temValorPrimeiro) {
            const primeiroId = novosAutores.shift();
            $primeiroSelectAutor.attr("data-selected", primeiroId);
            $primeiroSelectAutor.val("").trigger("change");
            inicializarSelectAutor($primeiroSelectAutor);
            $primeiroCampoAutor.find(".remove-autor").hide();
        }

        // Para os demais valores, cria novas linhas com botão remover
        novosAutores.forEach((id) => {
            const $campo = $(
                `<div class="input-group mb-2 autor-field">
                    <select name="autores[]" class="form-select autor-select"></select>
                    <button type="button" class="btn btn-danger remove-autor">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>`
            );
            $("#autores-container").append($campo);
            const $select = $campo.find(".autor-select");
            $select.attr("data-selected", id);
            $select.val("").trigger("change");
            inicializarSelectAutor($select);
            $campo.find(".remove-autor").show();
        });
        atualizarBotoesRemover("autor");
        atualizarBotao("autor");
    }

    // === ASSUNTOS ===
    if (novosAssuntos.length > 0) {
        const $primeiroCampoAssunto = $(".assunto-field").first();
        const $primeiroSelectAssunto =
            $primeiroCampoAssunto.find(".assunto-select");
        const temValorPrimeiroAssunto =
            $primeiroSelectAssunto.val() ||
            $primeiroSelectAssunto.data("selected");

        // Usa a primeira linha existente para o primeiro valor (sem botão remover)
        if (!temValorPrimeiroAssunto) {
            const primeiroIdAssunto = novosAssuntos.shift();
            $primeiroSelectAssunto.attr("data-selected", primeiroIdAssunto);
            $primeiroSelectAssunto.val("").trigger("change");
            inicializarSelectAssunto($primeiroSelectAssunto);
            $primeiroCampoAssunto.find(".remove-assunto").hide();
        }

        // Para os demais valores, cria novas linhas com botão remover
        novosAssuntos.forEach((id) => {
            const $campo = $(
                `<div class="input-group mb-2 assunto-field">
                    <select name="assuntos[]" class="form-select assunto-select"></select>
                    <button type="button" class="btn btn-danger remove-assunto">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>`
            );
            $("#assuntos-container").append($campo);
            const $select = $campo.find(".assunto-select");
            $select.attr("data-selected", id);
            $select.val("").trigger("change");
            inicializarSelectAssunto($select);
            $campo.find(".remove-assunto").show();
        });
        atualizarBotoesRemover("assunto");
        atualizarBotao("assunto");
    }

    // AUTOR Edit
    $(".autor-select").each(function () {
        const selectedId = $(this).data("selected");
        if (selectedId) {
            const $select = $(this);
            $.ajax({
                url: "/api/autores/search",
                data: { id: selectedId }, // <-- agora o controller entende 'id'
                dataType: "json",
                success: function (data) {
                    const item = data.find(
                        (x) => String(x.id) === String(selectedId)
                    );
                    if (item) {
                        const option = new Option(
                            item.text,
                            item.id,
                            true,
                            true
                        );
                        $select.append(option).trigger("change");
                    }
                },
            });
        }
    });

    // ASSUNTO Edit
    $(".assunto-select").each(function () {
        const selectedId = $(this).data("selected");
        if (selectedId) {
            const $select = $(this);
            $.ajax({
                url: "/api/assuntos/search",
                data: { id: selectedId },
                dataType: "json",
                success: function (data) {
                    const item = data.find(
                        (x) => String(x.id) === String(selectedId)
                    );
                    if (item) {
                        const option = new Option(
                            item.text,
                            item.id,
                            true,
                            true
                        );
                        $select.append(option).trigger("change");
                    }
                },
            });
        }
    });

    function atualizarBotao(tipo) {
        const selects = document.querySelectorAll(`.${tipo}-select`);
        const botao = document.getElementById(`add-${tipo}`);

        // se o botão não existir, sai da função
        if (!botao || selects.length === 0) return;

        const ultimo = selects[selects.length - 1];
        const valor = $(ultimo).val();
        botao.disabled = !valor || valor.length === 0;
    }

    // === Atualiza botões de remover ===
    function atualizarBotoesRemover(tipo) {
        const botoes = document.querySelectorAll(`.remove-${tipo}`);

        botoes.forEach((btn, index) => {
            // o primeiro campo nunca pode ser removido
            if (index === 0) {
                btn.style.display = "none";
            } else {
                btn.style.display = "inline-block";
            }

            btn.onclick = () => {
                btn.closest(`.${tipo}-field`).remove();
                atualizarBotao(tipo);
                atualizarBotoesRemover(tipo); // revalida após remover
            };
        });
    }

    // === Inicializa os selects existentes (primeiros campos) ===
    inicializarSelectAutor($(".autor-select"));
    inicializarSelectAssunto($(".assunto-select"));
    atualizarBotao("autor");
    atualizarBotao("assunto");
    atualizarBotoesRemover("autor");
    atualizarBotoesRemover("assunto");

    // === Editora: inicialização e preenchimento com old()/edit ===
    const $editoraSelect = $(".editora-select");
    if ($editoraSelect.length) {
        // Esconde o botão remover editora ao iniciar
        $(".remove-editora").hide();
        inicializarSelectEditora($editoraSelect);

        const oldEditora = window.livroOld?.editora;
        const selectedData = $editoraSelect.data("selected");
        const selectedId = oldEditora ?? selectedData;

        if (selectedId) {
            $.ajax({
                url: "/api/editoras/search",
                data: { id: selectedId },
                dataType: "json",
                success: function (data) {
                    const item = data.find(
                        (x) => String(x.id) === String(selectedId)
                    );
                    if (item) {
                        const option = new Option(
                            item.text,
                            item.id,
                            true,
                            true
                        );
                        $editoraSelect.append(option).trigger("change");
                    }
                },
            });
        }

        // Clique do botão vermelho para limpar a editora
        $(document).on("click", ".remove-editora", function () {
            $editoraSelect.val(null).trigger("change");
            $(this).hide();
        });
    }

    // === Evento: adicionar novo campo de autor ===
    $("#add-autor").on("click", function () {
        const container = $("#autores-container");
        const div = $(`
            <div class="input-group mb-2 autor-field">
                <select name="autores[]" class="form-select autor-select"></select>
                <button type="button" class="btn btn-danger remove-autor">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        `);
        container.append(div);
        inicializarSelectAutor(div.find("select"));
        atualizarBotoesRemover("autor");
        atualizarBotao("autor");
    });

    // === Evento: adicionar novo campo de assunto ===
    $("#add-assunto").on("click", function () {
        const container = $("#assuntos-container");
        const div = $(`
            <div class="input-group mb-2 assunto-field">
                <select name="assuntos[]" class="form-select assunto-select"></select>
                <button type="button" class="btn btn-danger remove-assunto">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        `);
        container.append(div);
        inicializarSelectAssunto(div.find("select"));
        atualizarBotoesRemover("assunto");
        atualizarBotao("assunto");
    });

    // === Confirmação de delete ===
    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const form = button.closest("form");
            Swal.fire({
                title: "Tem certeza?",
                text: "Essa ação não poderá ser desfeita!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("keydown", function (e) {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                form.submit();
            }
        });
    }

    const formRelatoriosAutores = document.getElementById("relatorios-autores");
    const exportButton = document.getElementById("btnExportarCsv");

    if (!formRelatoriosAutores || !exportButton || !window.ROUTES?.exportCsv)
        return;

    exportButton.addEventListener("click", () => {
        const params = new URLSearchParams(
            new FormData(formRelatoriosAutores)
        ).toString();
        window.open(`${window.ROUTES.exportCsv}?${params}`, "_blank");
    });
});
