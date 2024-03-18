

var sum =7+10;

if (sum <15)
{
    console.log('pass');

}

else{
    console.log('failed');
}


document.getElementById('input2').addEventListener('input', function () {
    const input1 = document.getElementById("input1").value;
        const input2 = document.getElementById("input2").value;

        const sum = input1 * input2;
        document.getElementById("show-sum").innerHTML = sum;
});
