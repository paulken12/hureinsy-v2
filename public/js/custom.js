$('#multiselect1').multiselect({
    // ...
    onChange: function() {
        let selected = this.$select.val();
        // ...
    }
});