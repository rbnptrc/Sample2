const locationCheckout = window.location.pathname === '/checkout'

if (locationCheckout) {

    // Getting the total
    const host = window.location.host;
    let total
    $.ajax({
        type: "GET",
        url: `http://${host}/gettotal/`,
    
        dataType: "json",
        success: function (response) {
          total = parseFloat(response);
          console.log(total);
        }
    })
    
    // Render the PayPal button into #paypal-button-container
    
    paypal.Buttons({
    
        // Set up the transaction
        
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total
                    }
                }]
            });
        },
    
        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {

                $.ajax({
                    type: "GET",
                    url: `http://${host}/orders/`,
                
                    dataType: "json",
                    success: function (response) {
                      if (response) {
                          // Show a success message to the buyer
                Swal.fire(
                    'Thank you!',
                    'Your order has been sent! You will be redirected!',
                    'success'
                  )
                  setTimeout(() => {
                      window.location.replace(`http://${host}/remove-cart/`);
                  }, 2500)
                      }
                    }
                })

            });
        }
    
    
    }).render('#paypal-button-container');
}
