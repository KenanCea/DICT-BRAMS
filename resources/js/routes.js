export const routes = [
  {
    path: '*',
    component: require('./components/404Page.vue').default
  }, {
    path: '/dashboard',
    component: require('./components/Dashboard.vue').default
  }, {
    path: '/barangayclearance',
    component: require('./components/BarangayClearance.vue').default
  }, {
    path: '/barangaycertificate',
    component: require('./components/BarangayCertificate.vue').default
  }, {
    path: '/businessclearance',
    component: require('./components/BusinessClearance.vue').default
  }, {
    path: '/filedcase',
    component: require('./components/FiledCase.vue').default
  }, {
    path: '/inhabitants',
    component: require('./components/Inhabitant.vue').default
  }, {
    path: '/households',
    component: require('./components/Household.vue').default
  }, {
    path: '/useraccount',
    component: require('./components/UserAccount.vue').default
  }, {
    path: '/printdocument',
    component: require('./components/PrintDocument.vue').default
  }, {
    path: '/childrenWithConflict',
    component: require('./components/ChildrenWithConflicts.vue').default
  }, {
    path: '/listOfRegisteredVoters',
    component: require('./components/ListOfRegisteredVoters.vue').default
  }, {
    path: '/listOfProspectiveSkVoters',
    component: require('./components/ListOfProspectiveSKVoters.vue').default
  }, {
    path: '/listOfSeniorCitizens',
    component: require('./components/ListOfSeniorCitizens.vue').default
  }, {
    path: '/listOfOutOfSchoolYouth7-14',
    component: require('./components/ListOfOutOfSchoolYouth7-14.vue').default
  }, {
    path: '/listOfOutOfSchoolYouth15-25',
    component: require('./components/ListOfOutOfSchoolYouth15-25.vue').default
  }, {
    path: '/monthlyMonitoring',
    component: require('./components/Immunized-monthlyMonitoring.vue').default
  }, {
    path: '/vitaminAMonitoring',
    component: require('./components/Immunized-vitaminA.vue').default
  }, {
    path: '/dewormingMonitoring',
    component: require('./components/Immunized-deworming.vue').default
  }, {
    path: '/quarterlyMonitoring',
    component: require('./components/immunized-quarteryMonitoring.vue').default
  }, {
    path: '/archivedInhabitants',
    component: require('./components/ArchivedInhabitants.vue').default
  }, {
    path: '/archivedHouseholds',
    component: require('./components/ArchivedHouseholds.vue').default
  }, {
    path: '/secretaryduties',
    component: require('./components/SecretaryDuties.vue').default
  }, {
    path: '/needquestions',
    component: require('./components/NeedQuestions.vue').default
  }, {
    path: '/dev',
    component: require('./components/dev.vue').default
  }, {
    path: '/barangaykiosk',
    component: require('./components/BarangayKiosk.vue').default
  }, {
    path: '/populationGenderAge',
    component: require('./components/PopulationGenderAge.vue').default
  }, {
    path: '/civilstatusTribe',
    component: require('./components/CivilstatusTribe.vue').default
  }, {
    path: '/familysizeReligion',
    component: require('./components/FamilySizeReligion.vue').default
  }, {
    path: '/bloodtypeHealth',
    component: require('./components/BloodtypeHealth.vue').default
  }, {
    path: '/planningDeath',
    component: require('./components/PlanningDeath.vue').default
  }, {
    path: '/nutritionWaterGarbage',
    component: require('./components/NutritionWaterGarbage.vue').default
  }, {
    path: '/garbCollectionToiletTenurial ',
    component: require('./components/GarbCollectionToiletTenurial.vue').default
  }, {
    path: '/constMtlsResidencyCrime',
    component: require('./components/ConstMtlsResidencyCrime.vue').default
  }, {
    path: '/familyIncomeEconomicActivity ',
    component: require('./components/FamilyIncomeEconomicActivity.vue').default
  }, {
    path: '/jobStatusIndustry ',
    component: require('./components/JobStatusIndustry.vue').default
  }, {
    path: '/educationAchievement',
    component: require('./components/EducationAchievement.vue').default
  }, {
    path: '/soloParent',
    component: require('./components/SoloParent.vue').default
  }, {
    path: '/disability',
    component: require('./components/Disability.vue').default
  }]
