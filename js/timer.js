let TotalMinutes=1;
let time = 1*60;
const totalMS=TotalMinutes*61500;
let minutes;
let seconds;

let timer = document.querySelector('.timer');
const int=setInterval(counter,1000);
function counter(){
        minutes=Math.floor(time/60);
        seconds=time%60;

        seconds = seconds < 10 ? '0'+ seconds : seconds;

        if(minutes==1){
            
        }
    
        timer.innerHTML= `${minutes}:${seconds}`
        time--;
}

setTimeout(()=>{
    clearInterval(int);
},totalMS);
  



