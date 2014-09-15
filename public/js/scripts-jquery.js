function DialogClose(IdDialogo)
{
    $(IdDialogo).dialog('close');
}
function DialogOpen(IdDialogo)
{
    $(IdDialogo).dialog('open');
}
function DialogButtonDisabled(Botones)
{
    $(Botones).button("option", "disabled", true);
}
function DialogButtonEnabled(Botones)
{
    $(Botones).button("option", "disabled", false);
}