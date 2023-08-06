const emptbl = document.getElementById("emoployee");
const apptbl = document.getElementById("appointment");
const commtbl = document.getElementById("comment");



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
