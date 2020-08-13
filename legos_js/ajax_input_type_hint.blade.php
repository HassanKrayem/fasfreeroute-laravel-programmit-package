function setAjaxTypingHint(inputEle, dataListId, jsonURL, typeHintingFunc, min_characters = 1)
{
    let globObjecName = dataListId + '_ajax_type_hinting';
    window[globObjecName] = new XMLHttpRequest();

    inputEle = document.getElementById(inputEle);
    inputEle.addEventListener("keyup", function(event){
        
        //alert(event.keyCode)
        if(event.keyCode >= 37 && event.keyCode <= 40 || event.keyCode == 13)
            return;
        // retireve the input element
        let input = event.target.value;        

        // retrieve the datalist element
        let huge_list = document.getElementById(dataListId);

        // minimum number of characters before we start to generate suggestions
        
        if (input.length < min_characters ) { 
            return;
        } else {                        
            // abort any pending requests
            window[globObjecName].abort();            
            window[globObjecName].onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    // We're expecting a json response so we convert it to an object
                    let response = JSON.parse( this.responseText ); 
                    {{--  console.log('Type Hiting:');
                    console.log(this.responseText);
                    console.log(response);  --}}

                    // clear any previously loaded options in the datalist
                    huge_list.innerHTML = "";

                    if(typeof typeHintingFunc == 'function')
                    {
                        typeHintingFunc(response, huge_list, inputEle);
                    }
                    else
                    {
                        response.forEach(function(item) {
                            // Create a new <option> element.
                            let option = document.createElement('option');
                            option.value = item;
    
                            // attach the option to the datalist element
                            huge_list.appendChild(option);
                        });
                        {{--  let event = new Event('keyup'); --}}
                        
                        {{--  let event = new MouseEvent('click', {
                            view: window,
                            bubbles: true,
                            cancelable: true
                          });
                        
                        inputEle.dispatchEvent(event)
                        inputEle.dispatchEvent(event)  --}}

                    }
                    
                }
            };

            window[globObjecName].open("GET", jsonURL + encodeURIComponent(input), true);
            window[globObjecName].send()
        }

    });
}