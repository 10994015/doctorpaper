let num = 0;
let stopNum = 0;
const app =  document.getElementById('app');
let x = 0;
let y = 0;
let arr = [];
let timer = null;
const btn = document.getElementById('btn');
const btn2 = document.getElementById('btn2');
const btn3 = document.getElementById('btn3');
const btn4 = document.getElementById('btn4');
const coorText = document.getElementById('coorText');


function getMousePos(e){
    // console.log(e.pageY);
    x = e.x;
    y = e.y;
}
timer = setInterval(()=>{
    num = num +0.1;
    stopNum++;
    // console.log(stopNum);
    
    // if(stopNum == 600){
    //     clearInterval(timer);
    // }
    // console.log(num);
    
    if(Math.round(num) ==1){
        num = 0;
        app.addEventListener('mousemove',getMousePos);
        // console.log("X:", x);
        // console.log("Y:", y);
        coor = "("+x+","+y+")";
        arr.push(coor);
        // console.log(arr);
    }
},100)



function send(){
    const reArr = arr.reverse();
    arr.length  = arr.length - 1;
    arr = reArr.reverse();
    newstr = arr.join(",")
    // console.log(newstr);
    coorText.value = newstr;
    clearInterval(timer);
}
btn.addEventListener('click',send);

if(btn2){
    btn2.addEventListener('click',send);
}
if(btn3){
    btn3.addEventListener('click',send);
}
if(btn4){
    btn4.addEventListener('click',send);
}
