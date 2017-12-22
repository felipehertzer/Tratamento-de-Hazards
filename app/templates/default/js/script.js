/**
 * Created by User on 23/11/2015.
 */
var line = 1;

$("#clonar").click(function () {
    line = line + 1
    var clone = $(".linhas:first").clone();
    clone.find(".funcao").val("");
    clone.find(".rd").val("").prop("readOnly", false);
    clone.find(".rs1").val("").prop("readOnly", false);
    clone.find(".rs2").val("").prop("readOnly", false);
    clone.find(".selectOperacao").val(1).attr("data-select-line", line);
    clone.appendTo("#clones");
});

$("#gerar").click(function () {
    $.ajax({
        type: 'POST',
        url: '/arquitetura/ajax/calcular',
        data: $("form").serialize(),
        dataType: 'json',
        success: function (data) {
            $("#resultado").html(data.resultado);
            $("#cpi").html(data.cpi);
        }
    });
});

$(document).on('change', '.selectOperacao', function() {
    var linha = $(this).attr("data-select-line") - 1;
    var valor = $(this).val();
    switch(valor){
        case "1":
        case "2":
        case "3":
        case "4":
        case "7":
        case "8":
            if(linha != "0") {
                $("#clones .linhas:nth-child(" + linha + ") .rd").prop("readOnly", false);
                $("#clones .linhas:nth-child(" + linha + ") .rs1").prop("readOnly", false);
                $("#clones .linhas:nth-child(" + linha + ") .rs2").prop("readOnly", false);
            } else {
                $(".linhas:first .rd").prop("readOnly", false);
                $(".linhas:first .rs1").prop("readOnly", false);
                $(".linhas:first .rs2").prop("readOnly", false);
            }
            break;
        case "5":
        case "6":
            if(linha != "0") {
                $("#clones .linhas:nth-child(" + linha + ") .rd").prop("readOnly", false);
                $("#clones .linhas:nth-child(" + linha + ") .rs1").prop("readOnly", false);
                $("#clones .linhas:nth-child(" + linha + ") .rs2").prop("readOnly", true).val("0");
            } else {
                $(".linhas:first .rd").prop("readOnly", false);
                $(".linhas:first .rs1").prop("readOnly", false);
                $(".linhas:first .rs2").prop("readOnly", true).val("0");
            }
            break;
        case "9":
            if(linha != "0") {
                $("#clones .linhas:nth-child("+linha+") .rd").prop("readOnly", false);
                $("#clones .linhas:nth-child("+linha+") .rs1").prop("readOnly", true).val("0");
                $("#clones .linhas:nth-child("+linha+") .rs2").prop("readOnly", true).val("0");
            } else {
                $(".linhas:first .rd").prop("readOnly", false);
                $(".linhas:first .rs1").prop("readOnly", true).val("0");
                $(".linhas:first .rs2").prop("readOnly", true).val("0");
            }
            break;
        case "10":
            if(linha != "0") {
                $("#clones .linhas:nth-child("+linha+") .rd").prop("readOnly", true).val("0");
                $("#clones .linhas:nth-child("+linha+") .rs1").prop("readOnly", true).val("0");
                $("#clones .linhas:nth-child("+linha+") .rs2").prop("readOnly", true).val("0");
            } else {
                $(".linhas:first .rd").prop("readOnly", true).val("0");
                $(".linhas:first .rs1").prop("readOnly", true).val("0");
                $(".linhas:first .rs2").prop("readOnly", true).val("0");
            }
            break;
    }
});