document.querySelectorAll('.contestant-card').forEach(card => {
    card.addEventListener('click', function () {
        document.querySelectorAll('.contestant-card').forEach(c => {
            c.classList.remove('selected');
        });
        this.classList.add('selected');
    });
});