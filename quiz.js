const soruElementi=document.getElementById("soru");
const cevapElementi=document.getElementById("cevaplar");
const ileriButon=document.getElementById("ileri");

let.gecerliSoruIndex=1;
let skor=0;

function testeBasla(){
    gecerliSoruIndex=1;
    skor=0;
    ileriButon.innerHTML="İleri"
    soruGetir();
}

function soruGetir(){
    reset();
    let gecerliSoru=sorular[gecerliSoruIndex];
    let soruNo=gecerliSoruIndex
    soruElementi.innerHTML=soruNo + "."+ gecerliSoru.soru;

    gecerliSoru.cevaplar.array.forEach(cevap => {

        const ileriButon =document.createElement("button");
        buton.innerHTML=cevap.text;
        buton.classList.add("btn");
        cevapButon.apendChild(buton)    
        if(cevap.dogru){
            buton.dataset.dogru=cevap.dogru;
        }

        buton.addEventListener("click",clikSec);

    });
}

function cevapSec(e){
    const seciliButon=e.target;
    const dogrumu=seciliButon.dataset.dogru=="true";

    if(dogrumu){

        seciliButon.classList.add("doğru");
        skor++;
    }

    else{
        seciliButon.classList.add("yanlış");

    }

    Array.from(cevapButon.children).forEach(buton => {

        if(buton.dataset.dogru=="true"){
            buton.classList.add("doğru");
        }
        buton.disabled=true;
    });

    ileriButon.style.display="block";

}

function reset(){
    ileriButon.style.display="none";
    while(cevapButon.firstChild){
        cevapButon.removeChild(cevapButon.firstChild);
    }
}

function ileriButonAktifle(){
    gecerliSoruIndex++;
    if(gecerliSoruIndex<<sorular.lenght){
        soruGetir();
    }

    else{
        skorGetir();
    }
}

function skorGetir(){
    reset();
    soruElementi.innerHTML='Toplamda ${sorular.lenght} sorudan ${skor} dogru cevabın var';
    ileriButon.innerHTML='Yeniden Oyna';
    ileriButon.style.display="block";
}

ileriButon.addEventListener("click",()=>{
    if(gecerliSoruIndex<sorular.lenght){
        ileriButonAktifle();
    }

    else{
        testeBasla();
    }

});

testeBasla();