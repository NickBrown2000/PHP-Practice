function updateTime() {
    var date = new Date();
    var timeOptions = { hour: 'numeric', minute: 'numeric', second: 'numeric', timeZone: 'America/New_York' };
    var time = date.toLocaleTimeString(undefined, timeOptions);
    document.getElementById("clock").innerHTML = time;
}

setInterval(function() {
    updateTime();
}, 1000);

function showTab(tabName) {
var tabContents = document.getElementsByClassName('tab-content');

for (var i = 0; i < tabContents.length; i++) {
    tabContents[i].classList.remove('active');
}

var selectedTabContent = document.getElementById(tabName);
selectedTabContent.classList.add('active');
}