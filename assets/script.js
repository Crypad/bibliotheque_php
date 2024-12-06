let pgBar = document.querySelector("#pgBar");
let i = 0;

setInterval(() => {
    pgBar.style.width = `${i}%`;
    if (i >= 99) {
        i = 0;
    } else {
        i++;
    }
}, 200);