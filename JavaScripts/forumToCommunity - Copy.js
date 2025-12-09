const home = document.getElementById("homeDirect");
const marketplace = document.getElementById("marketplaceDirect");
const learn = document.getElementById("learnDirect");
const project = document.getElementById("projectDirect");

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

project.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.assign("communityCrowdfundingUI.html");
});
