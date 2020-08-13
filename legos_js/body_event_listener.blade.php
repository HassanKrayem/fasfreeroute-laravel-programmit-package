

	// native javascript function to check if element has class or not
	function hasClass(element, cls) {
	    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
	}

	// handling the targeted element by the mouse click and make some validations
	// Datadtables re-render the elements on resize event which is triggerd by responsive feature thus
	// we need to re-assign events for the elements that has been re-rendered - to avoid that
	// we check the elements it self if it does hold something that we can use to trigger
	// what we want
	document.addEventListener('click',function(e)
	{
		var t = e.target;

		if( hasClass(t, '_del') )
		{
			prepareAjaxRequestUI({
				ele: t,
				askQuestion: true,
				questionTitle: "Are you sure you want to delete this User ?",
				messageType: "info",
				buttonText: "Delete",
				buttonColor: "#FFC300",
				showCancelButton: true,
				actionURL: "account/stackholders/remove/"
			})
		}
		else if( hasClass(t, '_files'))
		{
			preperFilesRequest(t);
		}
		else if( hasClass(t, '_recycle') )
		{
			preperRestoreRequest(t);
		}

	})


	document.addEventListener('dblclick',function(e)
	{
		var t = e.target;

		if( hasClass(t, '_savenote') )
		{			
			saveNote(t)
		}

	})


	// for the onChange event we couldn't do it the way we would like as the above example 
	// so we fall back to the mass assignment events for all the avalible elements.
	table.on( 'responsive-display', function ( e, datatable, row, showHide, update ) {
    	//setCtrlChangeAccountStatusEvent();
	} );

//$("#entity_table_wrapper input").addClass("form-control").css({ backgroundImage: 'none', boxShadow : '0px 0px 2px #000', padding : '5px', content : 'SHOWADBOARDSMODAL'});


