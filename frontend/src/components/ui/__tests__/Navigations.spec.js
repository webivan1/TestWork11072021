import { shallowMount } from "@vue/test-utils";
import Navigation from "@/components/ui/Navigation";

describe("Heading.vue", () => {
  it("should render menu", () => {
    const menu = [
      { url: "/", text: "Home" },
      { url: "/create", text: "Create" },
    ];
    const nav = shallowMount(Navigation, {
      propsData: {
        menu,
      },
    });
    menu.forEach(({ text }) => {
      expect(nav.text()).toMatch(text);
    });
  });
});
