let starButtons=document.querySelectorAll('.starButton');

function response(data){
    console.log(data);
}

function vote(e){
    e.preventDefault();
    let starPic='s'+this.id;
    let starP='p'+this.id;
    starPic=document.querySelector('#'+starPic);
    starP=document.querySelector('#'+starP);
    if(starPic.dataset.state==='unchecked'){
        starPic.dataset.state='checked';
        starPic.src='images/star_on.svg';
        starP.innerHTML=parseInt(starP.innerHTML,10)+1;
        coldAjax("GET","php/voting.php?func=up&id="+this.id,response);
    }else if(starPic.dataset.state==='checked'){
        starPic.dataset.state='unchecked';
        starPic.src='images/star_off.svg';
        starP.innerHTML=parseInt(starP.innerHTML,10)-1;
        coldAjax("GET","php/voting.php?func=down&id="+this.id,response);
    }
}

function upvotesFill(data){
    let upvotes=JSON.parse(data);

    upvotes.forEach(element => {
        let starPic=document.querySelector('#s'+element);
        starPic.dataset.state='checked';
        starPic.src='images/star_on.svg';
    });
}

coldAjax("GET","php/voting.php?func=getUps",upvotesFill);

starButtons.forEach(element => {
    element.addEventListener('click',vote,false);
});