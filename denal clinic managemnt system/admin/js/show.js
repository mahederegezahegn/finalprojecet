const emptbl = document.getElementById("employee");
const apptbl = document.getElementById("appointment");
const commtbl = document.getElementById("comment");
// const adtb=document.getElementById("advices");
const adtb = document.getElementById("advices");
const comtb=document.getElementById("acomment");


function showemp(){
    emptbl.style.display="block";
    apptbl.style.display="none";
    commtbl.style.display="none";
}
function showapp(){
    emptbl.style.display="none";
    apptbl.style.display="block";
    commtbl.style.display="none";
}

function showcomm(){
    emptbl.style.display="none";
    apptbl.style.display="none";
    commtbl.style.display="block";
}

function showadd(){
    adtb.style.display="block";
    comtb.style.dispaly="none";
}


function showacomm(){
    adtb.style.display="none";
    comtb.style.display="block";
}

