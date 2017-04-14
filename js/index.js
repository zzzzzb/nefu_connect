/**
 * Created by Administrator on 2017/4/14.
 */
require(["publish"], function(publish){
    var oOpen = document.getElementById("open");
    oOpen.onclick = function() {
        var settings = {};
        publish.open(settings);
    }
});