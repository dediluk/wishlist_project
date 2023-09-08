const COLORS = ['#FED6BC', '#FFFADD', '#DEF7FE', '#E7ECFF', '#C3FBD8', '#FDEED9', '#F6FFF8', '#B5F2EA',
    '#C6D8FF', '#A8E4A0', '#E4717A'];
document.addEventListener("DOMContentLoaded", function (e) {
    const cards = document.getElementsByClassName('card_index');

    for (let card of cards) {
        card.addEventListener('mouseenter', (e) => {
            if (e.currentTarget.classList.contains('card_index')) {
                e.currentTarget.style.backgroundColor = COLORS[Math.floor(Math.random() * COLORS.length)];
            }
        })

        card.addEventListener('mouseleave', (e) => {
            e.currentTarget.style.backgroundColor = '';
        })

        card.childNodes.forEach((value) => {
            value.addEventListener("mouseenter", (e) => {
                e.stopPropagation();
            });
        });
    }
})


