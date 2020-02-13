/* select all textInputWrappers and check if its input is not empty if it isnt push the label up as if the input was active / focused */
const textWrappers=document.querySelectorAll('div.textInputWrapper');
textWrappers.forEach(item=>{
    const label=item.querySelector(':scope > label');
    item.querySelector(':scope > input').addEventListener('change',(event)=>{
        if(event.target.value && event.target.value.length){
            return label.classList.add("inputFilled")
        }
        label.classList.remove("inputFilled")
    })
})
