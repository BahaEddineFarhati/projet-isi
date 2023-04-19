

window.onload = () => {
    var myButtons = document.querySelectorAll(".sec_title");
    myButtons.forEach(function(myButton) {
    
        const page_id = myButton.dataset.tab;
      myButton.addEventListener("click", function() {
        document.querySelector('.dash_btn .tab.is-active').classList.remove('is-active');
        myButton.parentNode.classList.add('is-active');
        SwitchPage(page_id)
      });
    });
}

function SwitchPage (page_id) {
    console.log(page_id);

    const current_page = document.querySelector('.pages .page.is-active');
    current_page.classList.remove('is-active');

    const next_page = document.querySelector(`.pages .page[data-page="${page_id}"]`);
    next_page.classList.add('is-active');
}
