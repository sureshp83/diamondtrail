<form class="form-generic__form form-generic__form--left form-generic__form--wide"
      role="form"
      method="POST"
      action="{{ route('contact') }}">

    {{-- CSRF required for form submissions --}}
    {{ csrf_field() }}

    {{-- ROW 1 --}}
    <div class="form-generic__group">

        {{-- COMPANY NAME --}}
        <form_input
            error="{{ $errors->first('company_name') }}"
            label="Company Name"
            name="company_name"
            type="text"
        ></form_input>

        {{-- FULL NAME --}}
        <form_input
            error="{{ $errors->first('full_name') }}"
            label="Full Name"
            name="full_name"
            type="text"
        ></form_input>

    </div>

    {{-- ROW 2 --}}
    <div class="form-generic__group">

        {{-- EMAIL --}}
        <form_input
            error="{{ $errors->first('email') }}"
            name="email"
            label="Email address"
            type="email"
        ></form_input>

        {{-- PHONE --}}
        <form_input
            error="{{ $errors->first('phone') }}"
            label="Phone number"
            name="phone"
            type="text"
            :class_modifiers="['phone']"
        ></form_input>

    </div>

    {{-- SUBJECT --}}
    <form_input
        error="{{ $errors->first('subject') }}"
        label="Subject"
        name="subject"
        type="text"
    ></form_input>

    {{-- SUBJECT --}}
    <form_textarea
        error="{{ $errors->first('message') }}"
        label="Your Message"
        name="message"
    ></form_textarea>

    {{-- SUBMIT --}}
    <button type="submit"
            class="form-generic__submit button button--primary">
        Send your message
    </button>

</form>
