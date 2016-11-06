var getEnergy = function(pcm){
	var len = pcm.length;
	var win = new Array();
	var i = 0;
	while(i<len){
    	win.push(pcm.slice(i,i+1000));
    	i = i+1000;
	}
	/*var energy = new Array()*/
	/*i = 0;
	while(i<len){
		energy.push(0);
	}*/


	var energy = win.map(function(array){
        temparray = Array.from(array);
        temparray.unshift(0);
		return temparray.reduce(function(a,b){return a+b*b})
	})
	return energy;
}

