<template>
    <v-text-field v-model="text" :label="label" outlined dense></v-text-field>
</template>
<script>
export default {
    data: () => ({}),
    props: {
        text: "",
        description: "",
    },
    methods: {},
    watch: {
        description() {
            this.$emit("request", this.text);
        },
    },
};
</script>
