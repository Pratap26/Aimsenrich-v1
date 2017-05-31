<div id="myContainerElement"></div>

<script>
	// Render the button into the container element

	paypal.Button.render({

		// Pass the client ids to use to create your transaction on sandbox and production environments

		client: {
			sandbox:    '', // from https://developer.paypal.com/developer/applications/
			production: ''  // from https://developer.paypal.com/developer/applications/
		},

		// Pass the payment details for your transaction
		// See https://developer.paypal.com/docs/api/payments/#payment_create for the expected json parameters

		payment: function(actions) {
			return actions.payment.create({
				transactions: [
					{
						amount: {
							total:    '',
							currency: 'USD'
						}
					}
				]
			});
		},

		// Display a "Pay Now" button rather than a "Continue" button

		commit: true,

		// Pass a function to be called when the customer completes the payment

		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function(response) {
				console.log('The payment was completed!');
			});
		},

		// Pass a function to be called when the customer cancels the payment

		onCancel: function(data) {
			console.log('The payment was cancelled!');
		}

	}, '#myContainerElement');
</script>