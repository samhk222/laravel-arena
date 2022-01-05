module.exports = {
    env: {
        browser: true,
        es6: true,
    },
    extends: ["plugin:prettier/recommended", "plugin:vue/recommended", "prettier/vue"],
    globals: {
        Atomics: "readonly",
        SharedArrayBuffer: "readonly",
    },
    parserOptions: {
        ecmaVersion: 2018,
        sourceType: "module",
    },
    plugins: ["prettier", "vue"],
    rules: {
        "vue/html-self-closing": "off",
        "prettier/prettier": "error",
        "vue/require-default-prop": "off",
    },
};
