var LEQUENEFETCHMODALDATA_MODAL = lequene(
    {
        id:"LEQUENEFETCHMODALDATA_MODAL_ID",
        headerCancelButton: true,
        FooterCancelButton: false,
        ConfirmButton: false,
        ConfirmButtonFunc: function(){},
        ConfirmButtonText: "Confirm Button Text",
        ConfirmButtonClass: "btn-info",
        titlePrefix: "",
        titlePostfix: "",
        closeOnConfirm: false,
        clearModal: false,
        closeByEscKey: true,
        closeByCodeOnly: false,
        onOpen : function(){},
        onClose : function(){},
    });

LEQUENEFETCHMODALDATA_MODAL.born();

function lequeneFetchModalData(url, modalTitle, fixedData)
{
    let data = '';
    LEQUENEFETCHMODALDATA_MODAL.setTitle(modalTitle);
    LEQUENEFETCHMODALDATA_MODAL.body.innerHTML = ' ';
    console.log(typeof fixedData);
    if (typeof fixedData == "string") {
        LEQUENEFETCHMODALDATA_MODAL.setBody(fixedData);
        LEQUENEFETCHMODALDATA_MODAL.open();
    } else if (typeof fixedData == "object") {
        LEQUENEFETCHMODALDATA_MODAL.appendChild(fixedData);
        LEQUENEFETCHMODALDATA_MODAL.open();
    } else {
        if(url && url != "") {
            axios.get(url).then(response => {
            LEQUENEFETCHMODALDATA_MODAL.setBody(response.data);
            LEQUENEFETCHMODALDATA_MODAL.open();
            });
        } else {

            LEQUENEFETCHMODALDATA_MODAL.appendChild("No Data");
            LEQUENEFETCHMODALDATA_MODAL.open();

        }
        
    }
}