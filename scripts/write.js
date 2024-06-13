function typeFunc(){
    const typeSelect = document.getElementById('article-type').value;

    if(typeSelect == 'default'){
        document.querySelector('.review-form').style.display = "none";
        document.querySelector('.article-form').style.display = "none";
    }

    if(typeSelect == 'review'){
        document.querySelector('.review-form').style.display = "flex";
        document.querySelector('.article-form').style.display = "none";
        window.location.href = '#search-movie';
    }

    if(typeSelect == 'article'){
        document.querySelector('.article-form').style.display = "flex";
        document.querySelector('.review-form').style.display = "none";
    }
}

//search movies

const movieInput = document.getElementById('search-movie');

const reviewObj = new Object();


function searchFunc(){
    let displayArr = [];

    for(let i = 0; i < movieArr.length; i++){
        if(movieArr[i].m_title.toLowerCase().indexOf(movieInput.value.toLowerCase()) !== -1){
            let displayBtn = `<button type='button' class='movieBtn' id='movieBtn' onclick="pickMovie('${movieArr[i].m_title}', '${movieArr[i].m_release}', '${movieArr[i].m_id}')">${movieArr[i].m_title} (${movieArr[i].m_release.slice(0, 4)})</button>`;
            displayArr.push(displayBtn);
        }
    }

    if(movieInput.value == '' || movieInput.value == ' '){
        displayArr = [];
        document.getElementById('movieResults').innerHTML = '';
    }

    document.getElementById('movieResults').innerHTML = displayArr.join('');
}


function pickMovie(title, release, id){
    document.getElementById('movieResults').innerHTML = `<h3>${title} (${release.slice(0, 4)})</h3>`;
    //document.querySelector('.toggleReview').style.display = 'table';
    document.querySelector('.rating-dropdwn').style.display='table-cell';
    reviewObj.r_movie = id;
    reviewObj.r_user = userid;

    //create date
    const nDate = new Date();

    const nMonth = nDate.getMonth() + 1
    reviewObj.r_date = nDate.getFullYear().toString() + "-" + nMonth.toString() + "-" + nDate.getDate().toString();

    document.getElementById('movieid').value = id;


    console.log(reviewObj);
    window.location.href = '#rating-dropdwn';
}

movieInput.addEventListener('keyup', searchFunc);



//toggles sections variables
const ratingDrpDwn = document.getElementById('rating-dropdwn');

const summaryTxt = document.querySelector('.review-summary');

const reviewText = document.querySelector('.review');

const reviewSubmit = document.querySelector('.reviewBtn');


//Choosing rating

function ratingSelect(){
    if(ratingDrpDwn.value != 'default'){
        summaryTxt.style.display = 'table-cell';
        ratingDrpDwn.style.color = 'yellow';
    } else {
        summaryTxt.style.display = 'none';
        ratingDrpDwn.style.color = '#ccc';
    }
    window.location.href = '#review-summary';

    reviewObj.r_rating = document.getElementById('rating-dropdwn').value;
    console.log(reviewObj)
}

ratingDrpDwn.addEventListener('change', ratingSelect);

//summary functions


function rvwSumFunc(){
    reviewObj.r_summary = document.getElementById('review-summary').value;
    document.getElementById('summary-count').innerHTML = document.getElementById('review-summary').value.length;
    reviewText.style.display = 'table-cell';
}

summaryTxt.addEventListener('keyup', rvwSumFunc);

function rvwBtnLoc(){
    window.location.href = '#review';
    reviewSubmit.style.display = 'table-cell';
}

summaryTxt.addEventListener('focusout', rvwBtnLoc);

//review functions

function reviewFunc(){
    reviewObj.r_content = document.getElementById('review-text').value;
    console.log(reviewObj);
}





reviewText.addEventListener('keyup', reviewFunc);




//submit review
const reviewSubBtn = document.getElementById('submit-review');
