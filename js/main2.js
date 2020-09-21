//this function to avoid this error ->Cannot read property 'addEventListener' of null
//this is because it is returning null because it executes before the DOM fully loads.  

//------------------------------------------------------------------------------//
var i =0;
var images = [];
var time = 4000;

//images list

images[0]= 'imgs/slider/leftslider0.jpg';
images[1]= 'imgs/slider/leftslider1.jpg';
images[2]= 'imgs/slider/leftslider2.jpg';
images[3]= 'imgs/slider/leftslider3.jpg';

function changeImgs(){
    document.sliderImgs.src = images[i];
    if(i < images.length -1){
        i++;

    }else{
         i=0;   
    }
    setTimeout("changeImgs()", time);
}

window.onload = changeImgs;//to uploade images when load the website

//------------------------------------------------------------------------------//


function user_guide(){
    
//get the modal element
var modal = document.getElementById('simpleModal');
//get open modal button
var modalBtn = document.getElementById('modalBtn');
//get close button
var closeBtn = document.getElementsByClassName('closeBtn')[0];

//listen for a click open

modalBtn.addEventListener('click',openModal);

//listen for close click
closeBtn.addEventListener('click',closeModal);

//listen for outside click
window.addEventListener('click',outsideClick);

//function to open the modal
function openModal(){
modal.style.display = 'block';
    
}

//function to open the modal
function closeModal(){
modal.style.display = 'none'; 
}

//close a model when click outside the window
function outsideClick(e){
    if(e.target == modal){
        modal.style.display = 'none'; 
    }
    }

}

/*
window.onload=function(){

//------------------------------------------------------------------------------//
var i =0;
var images = [];
var time = 4000;

//images list

images[0]= 'imgs/slider/leftslider0.jpg';
images[1]= 'imgs/slider/leftslider1.jpg';
images[2]= 'imgs/slider/leftslider2.jpg';
images[3]= 'imgs/slider/leftslider3.jpg';

function changeImgs(){
    document.sliderImgs.src = images[i];
    if(i < images.length -1){
        i++;

    }else{
         i=0;   
    }
    setTimeout("changeImgs()", time);
}


//------------------------------------------------------------------------------//

};//end of window on load




//to avoid multiple onload override
var prev_handler = window.onload;
window.onload = function () {
    if (prev_handler) {
        prev_handler();
    }
    
};

*/
//login java script event to return the id of the user 

function clickedBtn(){

        var u_email = document.getElementById('u_email');

        window.alert("You are logged in as : "+u_email.value);

}

//show more - less for about us page

var content = document.getElementById("content");
var button = document.getElementById("show-more");

function show(){

    if(content.className="open"){//if its already open
        //shrink the box
        content.className="";
        button.innerHTML = "Show More";

    }else{
        //expand the box 
        content.className="open";
        button.innerHTML = "Show Less";
    }

};


// If user clicks anywhere outside of the modal, Modal will close
function search_suggestion(){
    
var modal = document.getElementById('search_result_container');
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = 'none';
}
}

}