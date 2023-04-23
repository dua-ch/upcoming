const closeBtn = document.querySelector(".close-btn");
closeBtn.onclick = () => {
  console.log("Close Button Clicked");
  // document.querySelector("header").style.width = 0;
  // document.querySelector("header .logo img").style.width = 0;
  // document
  //   .querySelectorAll("header li")
  //   .forEach((li) => (li.style.width = 0));
  // document.querySelector("main").style.margin = "50px";
  document.querySelector("header").style.display = "none";
  document.querySelector(".container").style.gridTemplateColumns = "1fr";
  document.querySelector("main").style.marginRight = "20px";
  document.querySelector("main").style.marginLeft = "20px";
  document.querySelector(".open-btn").style.display = "flex";
};

const openBtn = document.querySelector(".open-btn");
openBtn.onclick = () => {
  document.querySelector("header").style.display = "block";
  document.querySelector(".container").style.gridTemplateColumns = "96px 1fr";
  document.querySelector("main").style.marginRight = "0";
  document.querySelector("main").style.marginLeft = "0";
  document.querySelector(".open-btn").style.display = "none";
};

const cardNumber = document.querySelector(".card-number");
const expirationDate = document.querySelector(".expiration-date");
const cvc2Code = document.querySelector(".cvc2-code");

const cardNumberMask = new IMask(cardNumber, {
  mask: "0000 0000 0000 0000",
});

const expirationDateMask = new IMask(expirationDate, {
  mask: "MM{/}YY",
  groups: {
    YY: new IMask.MaskedPattern.Group.Range([0, 99]),
    MM: new IMask.MaskedPattern.Group.Range([1, 12]),
  },
});

const cvc2CodeMask = new IMask(cvc2Code, {
  mask: "0000",
});

const cardNumberContainer = document.getElementsByClassName(
  "card-number-wrapper"
)[0];
cardNumberContainer.onkeyup = function (e) {
  let target = e.srcElement;
  let maxLength = parseInt(target.attributes["maxlength"].value, 10);
  let myLength = target.value.length;
  let i = 0;
  if (myLength >= maxLength) {
    let next = target
    if(i == 0){
      next  = target.parentElement;
    } 
    i++;
    while ((next = next.nextElementSibling)) {
      if (next == null) break;
      if (next.tagName.toLowerCase() == "input") {
        next.focus();
        break;
      }
    }
  }
};