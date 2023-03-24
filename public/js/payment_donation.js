
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_51d1835dc32e6d4a5e52bc350f8fb78ceca9cd8e', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);

      fetch('verify_transaction?reference='+response.reference)
      .then(res => res.json())
      .then(res => {
        console.log(res);
        if(res.status){
            $(".alert").css("display", "block").addClass("alert-success").text(res.message);
            $(".alert").removeClass("alert-danger");
        }
        else{
            $(".alert").css("display", "block").addClass("alert-danger").text(res.message);
            $(".alert").removeClass("alert-success");
        }
      })
    }
  });

  handler.openIframe();
}

$("#donate").click(function(){
    $(".payment-form-parent").css("display", "block")
})

$(".close-donate-form").click(function(){
    $(".payment-form-parent").css("display", "none")
})