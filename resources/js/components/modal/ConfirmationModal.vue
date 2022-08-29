<template>
  <v-modal>
    <template v-slot:icon>
      <v-question-icon />
    </template>
    <template v-slot:main>
      <v-title> Are you sure? </v-title>
    </template>
    <template v-slot:handler>
      <v-accept-button @click="$emit('accept')">
        Accept <v-confirm-icon />
      </v-accept-button>
      <v-cancel-button @click="$emit('cancel')"> Cancel </v-cancel-button>
    </template>
  </v-modal>
</template>

<script>
import vModal from "./Modal.vue";
import vTitle from "../layout/Title.vue";
import vAcceptButton from "../buttons/AcceptButton.vue";
import vCancelButton from "../buttons/CancelButton.vue";
import vQuestionIcon from "../icons/QuestionIcon.vue";
import vConfirmIcon from "../icons/ConfirmIcon.vue";

export default {
  components: {
    vModal,
    vTitle,
    vQuestionIcon,
    vConfirmIcon,
    vAcceptButton,
    vCancelButton,
  },
};
</script>

<style></style>
