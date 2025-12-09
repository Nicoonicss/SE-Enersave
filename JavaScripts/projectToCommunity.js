const home = document.getElementById("homeDirect");
const marketplace = document.getElementById("marketplaceDirect");
const learn = document.getElementById("learnDirect");
const forum = document.getElementById("forumDirect");

home.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityUserUI.html");
});

marketplace.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityMarketplaceUI.html");
});

learn.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityLearnUI.html");
});

forum.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityForumUI.html");
});