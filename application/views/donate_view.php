<div class="donate_body p-5 w-100 mt-5">
    <div class="overlay-donate p-5">
        <p class="h1 font-weight-bold">It's more blessed to give than to receive.</p> 
        <p class="h5">Giving to the needy, especially the orphans and less privileged children, 
            is sure a service to God.
        </p>
        <p class="h2 pt-5 font-weight-bold">You wish to give to an orphanage?</p> 
        <p class="h5 pb-2"> And you do not have the time to check out which to give, 
            what to give or how to give, you may send a donation <button id="donate" class="btn pl-3 pr-3 btn-primary"> here </button>
        </p>
        <p>
        You can be rest assured that every donation goes to one or more orphanages.
        </p>
    </div>
</div>

<div class="payment-form-parent">
    <i class="las la-times close-donate-form" style="cursor: pointer; position: absolute; right: 0; font-size: 48px"></i>
    <div class="payment-form">
        <form id="paymentForm">
            <div class="alert"></div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email-address" required />
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" required />
            </div>
            <div class="form-group">
                <label for="first-name">Full Name</label>
                <input type="text" id="full-name" />
            </div>
            <div class="form-submit">
                <button type="submit" onclick="payWithPaystack()"> Pay </button>
            </div>
        </form>

        <script src="https://js.paystack.co/v1/inline.js"></script>
    </div>
</div>