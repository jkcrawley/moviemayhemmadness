function typeFunc(){
    const typeSelect = document.getElementById('article-type').value;

    if(typeSelect == 'default'){
        document.querySelector('.review-form').style.display = "none";
        document.querySelector('.article-form').style.display = "none";
    }

    if(typeSelect == 'review'){
        document.querySelector('.review-form').style.display = "flex";
        document.querySelector('.article-form').style.display = "none";
    }

    if(typeSelect == 'article'){
        document.querySelector('.article-form').style.display = "flex";
        document.querySelector('.review-form').style.display = "none";
    }
}