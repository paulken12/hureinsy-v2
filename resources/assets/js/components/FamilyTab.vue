<template>
    <h3>{{tab.name}}</h3>
</template>

<script>

    export default {

        props: ['tab'],

        data: function () {
            return {
                databaseOptions: [],
            };
        },

        methods: {},

    }
</script>