let timeLeft = document.querySelector(".time-left");
let quizContainer = document.getElementById("container");
let nextBtn = document.getElementById("next-button");
let countOfQuestion = document.querySelector(".number-of-question");
let displayContainer = document.getElementById("display-container");
let scoreContainer = document.querySelector(".score-container");
let restart = document.getElementById("restart");
let userScore = document.getElementById("user-score");
let startScreen = document.querySelector(".start-screen");
let startButton = document.getElementById("start-button");
let questionCount;
let scoreCount = 0;
let count = 11;
let countdown;
let currentQuizDiv; // Yeni eklenen satır

const quizArray = [
    {
        id: "0",
        questions: "She's married and she has three ...........",
        options: ["child", "childs", "children"],
        correct: "childs",
    },
    {
        id: "1",
        questions: "She is usually in bed by .......... (11.30)",
        options: ["half past eleven", "thirty past eleven", "eleven past thirty"],
        correct: "eleven past thirty",
    },
    {
        id: "2",
        questions: ".......... to concerts?",
        options: ["Does Sally go", "Do Sally goes", "Do Sally go"],
        correct: "Does Sally go",
    },
    {
        id: "3",
        questions: "We always have snow .......... January.",
        options: ["on", "it", "at"],
        correct: "in",
    },
    {
        id: "4",
        questions: "There isn't .......... sugar in this coffee!",
        options: ["no", "any", "some"],
        correct: "any",
    },
];

function quizDisplay(questionCount) {
    let quizCards = document.querySelectorAll(".container-mid");
    quizCards.forEach((card) => {
        card.classList.add("hide");
    });
    quizCards[questionCount].classList.remove("hide");

    // Kaçıncı soruda olduğunu gösteren span elementini güncelle
    document.getElementById("current-question").innerText = questionCount + 1;
}


function quizCreater() {
    quizArray.sort(() => Math.random() - 0.5);

    for (let i of quizArray) {
        let currentQuizDiv = document.createElement("div");
        currentQuizDiv.classList.add("container-mid", "hide");
        quizContainer.appendChild(currentQuizDiv);

        i.options.sort(() => Math.random() - 0.5);

        let question_DIV = document.createElement("p");
        question_DIV.classList.add("question");
        question_DIV.innerHTML = i.questions;
        currentQuizDiv.appendChild(question_DIV);

        currentQuizDiv.innerHTML += `
            <button class="option-div" onclick="checker(this)">
                ${i.options[0]}
            </button>
            <button class="option-div" onclick="checker(this)">
                ${i.options[1]}
            </button>
            <button class="option-div" onclick="checker(this)">
                ${i.options[2]}
            </button>
            <button class="option-div" onclick="checker(this)">
                ${i.options[3]}
            </button>
        `;
    }
}

function displayNext() {
    questionCount++;

    if (questionCount < quizArray.length) {
        clearInterval(countdown);
        count = 5;
        timerDisplay();
        quizDisplay(questionCount);
    } else {
        // Tüm sorular tamamlandıysa, sonucu göster
        showScore();
    }
}

function showScore() {
    // Kullanıcının puanını göster veya başka bir eylem yap
    let scoreText = `Your Score: ${scoreCount}/${quizArray.length}`;
    console.log(scoreText);  // Konsola yazdır

    // Skoru HTML içerisine yaz
    scoreContainer.innerHTML = scoreText;

    displayContainer.classList.add("hide");
    scoreContainer.classList.remove("hide");
}



// "Next Question" düğmesine tıklanma olayını dinle
nextBtn.addEventListener("click", displayNext);


const timerDisplay = () => {
    countdown = setInterval(() => {
        count--;
        timeLeft.innerHTML = `${count}s`;
        if (count === 0) {
            clearInterval(countdown);
            displayNext();
        }
    }, 1000);
};

function checker(userOption) {
    let userSolution = userOption.innerText;
    let question = document.querySelector(".container-mid:not(.hide)"); // Aktif olan soruyu seç
    let options = question.querySelectorAll(".option-div");

    if (userSolution === quizArray[questionCount].correct) {
        userOption.classList.add("correct");
        scoreCount++;
    } else {
        userOption.classList.add("incorrect");

        options.forEach((element) => {
            if (element.innerText === quizArray[questionCount].correct) {
                element.classList.add("correct");
            }
        });
    }


    


    clearInterval(countdown);
    options.forEach((element) => {
        element.disabled = true;
    });
}

function initial() {
    quizContainer.innerHTML = "";
    questionCount = 0;
    scoreCount = 0;
    count = 11;
    clearInterval(countdown);
    timerDisplay();
    quizCreater();
    quizDisplay(questionCount);
}

startButton.addEventListener("click", () => {
    startScreen.classList.add("hide");
    displayContainer.classList.remove("hide");
    initial();
});

window.onload = () => {
    startScreen.classList.remove("hide");
    displayContainer.classList.add("hide");
};
