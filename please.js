document.addEventListener("DOMContentLoaded", (e) => {
    var arrayOfCards = [{
            imgSrc: "./images/cat.png",
            id: 1,
            name: "cat"
        },
        {
            imgSrc: "./images/duck.png",
            id: 2,
            name: "duck"
        },
        {
            imgSrc: "./images/elephant.png",
            id: 3,
            name: "elephant"
        },
        {
            imgSrc: "./images/fish.png",
            id: 4,
            name: "fish"
        },
        {
            imgSrc: "./images/hippo.png",
            id: 5,
            name: "hippo"
        },
        {
            imgSrc: "./images/lion.gif",
            id: 6,
            name: "lion"
        },
        {
            imgSrc: "./images/panda.png",
            id: 7,
            name: "panda"
        },
        {
            imgSrc: "./images/penguin.png",
            id: 8,
            name: "penguin"
        },
        {
            imgSrc: "./images/cat.png",
            id: 9,
            name: "cat"
        },
        {
            imgSrc: "./images/duck.png",
            id: 10,
            name: "duck"
        },
        {
            imgSrc: "./images/elephant.png",
            id: 11,
            name: "elephant"
        },
        {
            imgSrc: "./images/fish.png",
            id: 12,
            name: "fish"
        },
        {
            imgSrc: "./images/hippo.png",
            id: 13,
            name: "hippo"
        },
        {
            imgSrc: "./images/lion.gif",
            id: 14,
            name: "lion"
        },
        {
            imgSrc: "./images/panda.png",
            id: 15,
            name: "panda"
        },
        {
            imgSrc: "./images/penguin.png",
            id: 16,
            name: "penguin"
        }
    ];


    arrayOfCards.sort(() => Math.random() - 0.5);


    var board = document.querySelector("section");
    var timer= document.getElementById("counter");
    var form= document.getElementById("scoreform");
   

    var count=0;
    var start=false;
    var matched=0;
    var interval=0;
    // var cardsChosen = [];
    // var cardsChosenId = [];

    function createBoard() {

        arrayOfCards.forEach(element => {
            var card = document.createElement("div");
            card.classList = "card";
            card.setAttribute("name", element.name);
            card.setAttribute("id", element.id);



            var face = document.createElement("img");
            face.classList = "face";
            face.src = element.imgSrc;
            // face.setAttribute("imgSrc",element.imgSrc);



            var back = document.createElement("img");
            back.classList = "back";
            back.src = "./images/cardback.jpg";


            board.appendChild(card);
            card.appendChild(face);
            card.appendChild(back);
            card.addEventListener("click", (e) => {
                // face.classList.toggle("toggleCard");
                // var cardId = card.getAttribute("id");
                // var naming = card.getAttribute("name")
                // cardsChosen.push(naming);
                // cardsChosenId.push(cardId);
                //    console.log(cardsChosenId);
                card.classList.toggle("toggleCard");
                

                checkCards(e);
                startcounter();
                console.log(count);





            });


        });


    }
   function startcounter(){
    if (start==false) {
       interval= window.setInterval(addtimer,1000); 
               start=true;

    }
   }
   function addtimer() {
    count++;
    timer.value=count;
    
    
   }
    var checkCards = (e) => {
        var clickCards = e.target;
        clickCards.classList.add("flipped");

        var flippedCards = document.querySelectorAll(".flipped");
        
      if (flippedCards.length===2) {
        if (flippedCards[0].getAttribute("name")===flippedCards[1].getAttribute("name")) {
            console.log("match");
            matched++;
            flippedCards.forEach(card=>{
                card.classList.remove("flipped");
                card.style.pointerEvents="none";
                if (matched==8) {
                    start=true;
                    var uploadscore=document.getElementById("uploadscore").value=count;
                    
                    window.clearTimeout(interval);
                    setTimeout((alert("You've won")),1000)
                    
                    form.submit();

                  
                }
            })
        } else {
            flippedCards.forEach((card) => {
                card.classList.remove("flipped");
                setTimeout(()=>card.classList.remove("toggleCard"),1000);

            });
        }
        
      }

        //    console.log(cardsChosenId);
        //    console.log(cardsChosen);
    };
    // function flipcard(){
    //     // var cardId= this.getAttribute('id');
    //     // cardsChosen.push(arrayOfCards[cardId].name);
    //     card.classList.toggle("toggleCard");
    // }

    createBoard();

});