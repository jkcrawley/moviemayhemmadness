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

//search movies

const movieInput = document.getElementById('search-movie');




function searchFunc(){
    console.log(movieArr);
    let displayArr = [];

    for(let i = 0; i < movieArr.length; i++){
        if(movieArr[i].m_title.toLowerCase().indexOf(movieInput.value.toLowerCase()) !== -1){
            let displayBtn = `<button type='button' class='movieBtn' id='movieBtn' onclick="pickMovie('${movieArr[i].m_title}', '${movieArr[i].m_release}', '${movieArr[i].m_id}')">${movieArr[i].m_title} (${movieArr[i].m_release.slice(0, 4)})</button>`;
            displayArr.push(displayBtn);
        }
    }

    if(movieInput.value == ''){
        displayArr = [];
    }

    document.getElementById('movieResults').innerHTML = displayArr.join('');
}


function pickMovie(title, release, id){
    document.getElementById('movieResults').innerHTML = `<h3>${title} (${release.slice(0, 4)})</h3>`;
    document.querySelector('.toggleReview').style.display = 'table';
}

movieInput.addEventListener('keyup', searchFunc);