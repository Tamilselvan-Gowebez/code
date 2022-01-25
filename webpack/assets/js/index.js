import "../scss/index.scss";
// import "../images/upload_test.png";
// import "../images/beach.jpg";

document.getElementById('input').addEventListener('keyup', function () {
    console.log(`${this.value} Test` )
    document.querySelector('#output').innerHTML = `${this.value} Test`;
});
