//check input
function validator(option){
    var formElement=document.querySelector(option.form);
    
    function validate(inputElement,rule){
        var errorMessage=rule.test(inputElement.value);
        var errorElement=inputElement.parentElement.querySelector(option.errorSelector);
        if(errorMessage)
        {
            errorElement.innerText=errorMessage;
            inputElement.parentElement.classList.add('ivalid');
        }
        else{
            errorElement.innerText='';
            inputElement.parentElement.classList.remove('ivalid');
        }
    }
    if(formElement){
        option.rules.forEach(rule => {
            var inputElement=formElement.querySelector(rule.selector);
            if(inputElement){
                inputElement.onblur=function(){
                    validate(inputElement,rule);
                }
                inputElement.oninput=function(){
                    var errorElement=inputElement.parentElement.querySelector(option.errorSelector);
                    errorElement.innerText='';
                    inputElement.parentElement.classList.remove('ivalid');
                }
            }
        });
    }

};
validator.isRequired=function(selector){
    return{
        selector:selector,
        test: function(value){
            return value.trim()?undefined:'Vui lòng nhập trường này'
        }
    }
};
validator.isEmail=function(selector){
    return{
        selector:selector,
        test: function(value){
            var regex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value)? undefined:'Vui lòng nhập đúng định dạng email';
        }
    }
};