let submit=document.querySelector('.submitTrack');
let successA=document.querySelector('.alert-success');
let failA=document.querySelector('.alert-danger');
successA.style.display='none';
failA.style.display='none';

function submitTrack(){
    let url=document.querySelector('.input').value;

    var id='';

    if(url.indexOf('v=')>0){
        id=url.split('v=');
        id=id[1].substring(0,11);
    }else if(url.indexOf('.be/')>0){
        console.log('bong');
        id=url.split('.be/');
        id=id[1];
    }else{
        id='failed';
    }

    if(id!==''&&id!=='failed'){
        coldAjax("GET","php/trackSubber.php?id="+id,result);
    }else if(id=='failed'){
        let warn=document.querySelector('.name');
        warn.style.display='block';
        warn.innerHTML='Failed to find proper url.';
    }else{
        let warn=document.querySelector('.name');
        warn.style.display='block';
        warn.innerHTML='Missed a field';
    }
}

function redirect(data){
    console.log(data);
    if(data=='success'){
        location.reload();
    }else{
        failA.style.display='block';
    }
}

function result(data){
        
    data = JSON.parse(data);
    if(data!==null){
        if(data.title!==null){
            console.log(data);
            let yid=data.thumbnail_url.split('vi/');
            yid=yid[1].substring(0,11);
            let title=data.title.replace("'","%27");
            console.log(title);
            coldAjax("GET",'php/trackNamer.php?title='+title+"&id="+yid,redirect);
        }else{
            failA.style.display='block';
        }
    }else{
        failA.style.display='block';
    }
    
}

submit.addEventListener('click',submitTrack,false);