module.exports = {
  preset: "@vue/cli-plugin-unit-jest",
  setupFiles: ["<rootDir>/tests/unit/setup.js"],
  transform: {
    "vee-validate/dist/rules": "babel-jest",
  },
  transformIgnorePatterns: [
    "<rootDir>/node_modules/(?!vee-validate/dist/rules)",
  ],
};
