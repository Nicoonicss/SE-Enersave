const home = document.getElementById("homeDirect");
const project = document.getElementById("projectDirect");
const learn = document.getElementById("learnDirect");
const forum = document.getElementById("forumDirect");


home.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityUserUI.html");
});

project.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityCrowdfundingUI.html");
});

learn.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityLearnUI.html");
});

forum.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityForumUI.html");
});
