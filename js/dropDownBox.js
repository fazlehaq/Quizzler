
    let veiw=document.querySelector('.veiw');
    let data=document.querySelector('.data');
    let flag=false;
    // data.style.display='none';
    veiw.addEventListener('click',function(){
        // data.style.display='block';
        flag=!flag;
        swapDisplay();
    })
    
    function swapDisplay(){
        if(data.style.display=='block'){
            data.style.display='none';
        }

        else{
            data.style.display='block';
        }
    }