const home = document.getElementById("homeDirect");
const marketplace = document.getElementById("marketplaceDirect");
const project = document.getElementById("projectDirect");
const forum = document.getElementById("forumDirect");

home.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityUserUI.html");
});

marketplace.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityMarketplaceUI.html");
});

project.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityCrowdfundingUI.html");
});

forum.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityForumUI.html");
});

