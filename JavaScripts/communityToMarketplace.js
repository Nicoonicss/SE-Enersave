const marketplace = document.getElementById("marketplaceDirect");
const project = document.getElementById("projectDirect");
const learn = document.getElementById("learnDirect");
const forum = document.getElementById("forumDirect");

marketplace.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityMarketplaceUI.html");
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