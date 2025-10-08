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

    const form = document.getElementById("form-livro");
    const anoInput = document.getElementById("ano_publicacao");
    const valorInput = document.getElementById("valor");

    if (form) {
        form.addEventListener("submit", function (e) {
            const anoAtual = new Date().getFullYear();
            const valorAno = parseInt(anoInput?.value || "", 10);

            if (!isNaN(valorAno) && valorAno > anoAtual) {
                e.preventDefault();
                Swal.fire({
                    icon: "warning",
                    title: "Ano inválido",
                    text: `O ano de publicação não pode ser maior que ${anoAtual}.`,
                    confirmButtonText: "Corrigir",
                    confirmButtonColor: "#3085d6",
                }).then(() => {
                    anoInput.value = "";
                    anoInput.focus();
                });
                return;
            }
        });
    }

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
});
