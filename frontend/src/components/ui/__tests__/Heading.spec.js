import { shallowMount } from "@vue/test-utils";
import Heading from "@/components/ui/Heading";

describe("Heading.vue", () => {
  it("should render and show slot", () => {
    const headingName = "Test heading";
    const heading = shallowMount(Heading, {
      slots: {
        default: headingName,
      },
    });
    expect(heading.text()).toMatch(headingName);
  });
});
