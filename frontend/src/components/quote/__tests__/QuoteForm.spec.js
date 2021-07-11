import { mount } from "@vue/test-utils";
import flushPromises from "flush-promises";
import QuoteForm from "@/components/quote/QuoteForm";

describe("QuoteForm.vue", () => {
  it("should be render form", () => {
    const btnText = "Button text";
    const successMessage = "Success message";

    const wrapper = mount(QuoteForm, {
      propsData: {
        btnText,
        successMessage,
      },
    });

    expect(wrapper.text()).toMatch(btnText);
    expect(wrapper.text()).toMatch(successMessage);

    ["task", "amount", "percentage", "reference"].forEach((field) => {
      const task = wrapper.find(`.test-${field}-field`);
      expect(task.exists()).toBe(true);
    });
  });

  it("check invalid form", async () => {
    const wrapper = mount(QuoteForm, {
      propsData: {
        btnText: "Create",
      },
    });

    wrapper.find(".test-task-field input").setValue("");
    wrapper.find(".test-amount-field input").setValue("");
    wrapper.find(".test-percentage-field input").setValue("");
    wrapper.find(".test-reference-field textarea").setValue("");

    await flushPromises();

    const text = wrapper.text();

    expect(text).toMatch("Task is not valid");
    expect(text).toMatch("Amount is not valid");
    expect(text).toMatch("Percentage is not valid");
  });

  it("check valid form", async () => {
    const wrapper = mount(QuoteForm, {
      propsData: {
        btnText: "Create",
      },
    });

    wrapper.find(".test-task-field input").setValue("Task Hello");
    wrapper.find(".test-amount-field input").setValue(33.44);
    wrapper.find(".test-percentage-field input").setValue(32);
    wrapper.find(".test-reference-field textarea").setValue("Some text...");

    await flushPromises();

    const text = wrapper.text();

    expect(text).not.toMatch("Task is not valid");
    expect(text).not.toMatch("Amount is not valid");
    expect(text).not.toMatch("Percentage is not valid");

    const handlerSubmit = jest.fn();

    wrapper.setMethods({
      submit: handlerSubmit,
    });

    wrapper.find("form").trigger("submit");

    await flushPromises();

    expect(handlerSubmit).toHaveBeenCalled();
  });
});
