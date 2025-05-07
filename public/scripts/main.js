document.addEventListener('DOMContentLoaded', function() {
    const up_btn = document.getElementById('up_btn');
    const down_btn = document.getElementById('down_btn');
    
    if (up_btn) {
        up_btn.addEventListener('click',(event)=>{
            change_rate_fetch(event);
        });
    }
    
    if (down_btn) {
        down_btn.addEventListener('click',(event)=>{
            change_rate_fetch(event);
        });
    }
});

function change_rate_fetch(e) {
    e.preventDefault();
    
    let post_id = +e.target.dataset.postId;
    let action = +e.target.dataset.action;
    
    if(post_id && action) {
        fetch('/posts', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "action" : action,
                "post_id": post_id
            })
        })
        .then((response) => response.text())
        .then((rate) => {
            const rate_p = document.getElementById('rate_p');
            if (rate_p) {
                rate_p.innerHTML = 'Rate: ' + rate;
            }
        })
    }
}
