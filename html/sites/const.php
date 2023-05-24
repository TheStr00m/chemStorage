<?php
	
	$jsonFile = file_get_contents("../config.json");
	$jsonContent = json_decode($jsonFile, true);
	extract($jsonContent);

    $registrationSelectArray = array(
        "home"=>$locations,
        "location"=>$locations
    );
	$employees = array(
		"employees"=>$employees
	);

	//HazCodes with multiple haz-cats
	$obscuredHazCodes = array(
		"H207"=> array(
			"Desen. Expl. 2"=>array("Desensitized explosives","Category 2"),
			"Desen. Expl. 3"=>array("Desensitized explosives","Category 3")),
		"H221"=> array(
			"Flam. Gas 1B"=>array("Flammable Gases","Category 1B"),
			"Flam. Gas 2"=>array("Flammable Gases","Category 2")),
		"H228"=> array(
			"Flam. Sol. 1"=>array("Flammable Solids","Category 1"),
			"Flam. Sol. 2"=>array("Flammable Solids","Category 2")),
		"H229"=> array(
			"Aerosol 1"=>array("Aerosols","Category 1"),
			"Aerosol 2"=>array("Aerosols","Category 2"),
			"Aerosol 3"=>array("Aerosols","Category 3")),
		"H242"=> array(
			"Self-react. CD"=>array("Self-reactive substances and mixtures","Type C, D"),
			"Org. Perox. CD"=>array("Organic peroxides","Type C, D"),
			"Self-react. EF"=>array("Self-reactive substances and mixtures","Type E, F"),
			"Org. Perox. EF"=>array("Organic peroxides","Type E, F")),
		"H250"=> array(
			"Pyr. Liq. 1"=>array("Pyrophoric liquids","Category 1"),
			"Pyr. Sol. 1"=>array("Pyrophoric solids","Category 1")),
		"H261"=> array(
			"Water-react. 2"=>array("Substances and mixtures which in contact with water, emit flammable gases","Category 2"),
			"Water-react. 3"=>array("Substances and mixtures which in contact with water, emit flammable gases","Category 3")),
		"H272"=> array(
			"Ox. Liq. 2"=>array("Oxidizing liquids","Category 2"),
			"Ox. Sol. 2"=>array("Oxidizing solids","Category 2"),
			"Ox. Liq. 3"=>array("Oxidizing liquids","Category 3"),
			"Ox. Sol. 3"=>array("Oxidizing solids","Category 3")),
		"H280"=> array(
			"Compressed gas"=>array("Gases under pressure","Compressed gas"),
			"Condensed gas"=>array("Gases under pressure","Condensed gas"),
			"Dissolved gas"=>array("Gases under pressure","Dissolved gas")),
		"H300"=> array(
			"Acute Tox. 1"=>array("Acute toxicity, oral","Category 1"),
			"Acute Tox. 2"=>array("Acute toxicity, oral","Category 2")),
		"H310"=> array(
			"Acute Tox. 1"=>array("Acute toxicity, dermal","Category 1"),
			"Acute Tox. 2"=>array("Acute toxicity, dermal","Category 2")),
		"H314"=> array(
			"Skin Corr. 1A"=>array("Skin corrosion/irritation","Category 1A"),
			"Skin Corr. 1B"=>array("Skin corrosion/irritation","Category 1B"),
			"Skin Corr. 1C"=>array("Skin corrosion/irritation","Category 1C"),
			"Skin Corr. 1"=>array("Skin corrosion/irritation","Category 1")),
		"H317"=> array(
			"Skin Sens. 1A"=>array("Sensitization, Skin","Category 1A"),
			"Skin Sens. 1B"=>array("Sensitization, Skin","Category 1B"),
			"Skin Sens. 1"=>array("Sensitization, Skin","Category 1")),
		"H330"=> array(
			"Acute Tox. 1"=>array("Acute toxicity, inhalation","Category 1"),
			"Acute Tox. 2"=>array("Acute toxicity, inhalation","Category 2")),
		"H334"=> array(
			"Resp. Sens. 1A"=>array("Sensitization, respiratory","Category 1A"),
			"Resp. Sens. 1B"=>array("Sensitization, respiratory","Category 1B"),
			"Resp. Sens. 1"=>array("Sensitization, respiratory","Category 1")),
		"H340"=> array(
			"Muta. 1A"=>array("Germ cell mutagenicity","Category 1A"),
			"Muta. 1B"=>array("Germ cell mutagenicity","Category 1B")),
		"H350"=> array(
			"Carc. 1A"=>array("Carcinogenicity","Category 1A"),
			"Carc. 1B"=>array("Carcinogenicity","Category 1B")),
		"H360"=> array(
			"Repr. 1A"=>array("Reproductive toxicity","Category 1A"),
			"Repr. 1B"=>array("Reproductive toxicity","Category 1B"))
	);


	//Array for hazard-code clarification and translation
	$classAssoc = array(
		//Physical Hazards
		
		"H200"=> array("Explosives","Unstable explosive"),
		"H201"=> array("Explosives", "Division 1.1"),
		"H202"=> array("Explosives", "Division 1.2"),
		"H203"=> array("Explosives", "Division 1.3"),
		"H204"=> array("Explosives", "Division 1.4"),
		"H205"=> array("Explosives", "Division 1.5"),

		"H206"=> array("Desensitized explosives", "Category 1"),
		"H208"=> array("Desensitized explosives", "Category 4"),


		"H220"=> array("Flammable gases","Category 1A"),
		"H222"=> array("Aerosol","Category 1"),
		"H223"=> array("Aerosol","Category 2"),

		"H224"=> array("Flammable liquids","Category 1"),
		"H225"=> array("Flammable liquids","Category 2"),
		"H226"=> array("Flammable liquids","Category 3"),
		"H227"=> array("Flammable liquids","Category 4"),

		"H230"=> array("Flammable gases","Category 1A, chemically unstable gas A"),
		"H231"=> array("Flammable gases","Category 1A, chemically unstable gas B"),
		"H232"=> array("Flammable gases","Category 1A, pyrophoric gas"),

		"H240"=> array("Self-reactive substances and mixtures/Organic Peroxides","Type A"),
		"H241"=> array("Self-reactive substances and mixtures/Organic Peroxides","Type B"),

		"H251"=> array("Self-heating substances and mixtures","Category 1"),
		"H252"=> array("Self-heating substances and mixtures","Category 2"),

		"H260"=> array("Substances or mixtures which in contact with water emit flammable gases","Category 1"),

		"H270"=> array("Oxidising gases","Category 1"),
		"H271"=> array("Oxidising liquid/solid","Category 1"),

		"H281"=> array("Gases under pressure","Refrigerated liquefied gas"),


		"H290"=> array("Corrosive to metals","Category 1"),

		//Health Hazards
		"H301"=> array("Acute toxicity, oral","Category 3"),
		"H302"=> array("Acute toxicity, oral","Category 4"),
		"H303"=> array("Acute toxicity, oral","Category 5"),

		"H304"=> array("Aspiration hazard","Category 1"),
		"H305"=> array("Aspiration hazard","Category 2"),

		"H311"=> array("Acute toxicity, dermal","Category 3"),
		"H312"=> array("Acute toxicity, dermal","Category 4"),
		"H313"=> array("Acute toxicity, dermal","Category 5"),

		"H331"=> array("Acute toxicity inhalation","Category 3"),
		"H332"=> array("Acute toxicity inhalation","Category 4"),
		"H333"=> array("Acute toxicity inhalation","Category 5"),

		"H315"=> array("Skin corrosion/irritation","Category 2"),
		"H316"=> array("Skin corrosion/irritation","Category 3"),

		"H318"=> array("Serious eye damage / eye irritation","Category 1"),
		"H319"=> array("Serious eye damage / eye irritation","Category 2A"),
		"H320"=> array("Serious eye damage / eye irritation","Category 2B"),

		"H331"=> array("Acute toxicity, inhalation","Category 3"),
		"H332"=> array("Acute toxicity, inhalation","Category 4"),
		"H333"=> array("Acute toxicity, inhalation","Category 5"),

		"H335"=> array("Specific target organ toxicity, single exposure; Respiratory tract irritation","Category 3"),
		"H336"=> array("Specific target organ toxicity, single exposure; Narcotic effects","Category 3"),

		
		"H341"=> array("Germ cell mutagenicity","Category 2"),

		"H351"=> array("Carcinogenicity","Category 2"),

		"H361"=> array("Reproductive toxicity","Category 2"),
		"H362"=> array("Reproductive toxicity, effects on or via lactation","Additional category"),


		"H370"=> array("Specific target organ toxicity (single exposure)","Category 1"),
		"H371"=> array("Specific target organ toxicity (single exposure)","Category 2"),
		"H372"=> array("Specific target organ toxicity (repeated exposure)","Category 1"),
		"H373"=> array("Specific target organ toxicity (repeated exposure)","Category 2"),

		//Environmental Hazards
		"H400"=> array("Hazardous to the aquatic environment, acute hazard","Category 1"),
		"H401"=> array("Hazardous to the aquatic environment, acute hazard","Category 2"),
		"H402"=> array("Hazardous to the aquatic environment, acute hazard","Category 3"),

		"H410"=> array("Hazardous to the aquatic environment, long-term hazard","Category 1"),
		"H411"=> array("Hazardous to the aquatic environment, long-term hazard","Category 2"),
		"H412"=> array("Hazardous to the aquatic environment, long-term hazard","Category 3"),
		"H413"=> array("Hazardous to the aquatic environment, long-term hazard","Category 4"),

		"H420"=> array("Hazardous to the ozone layer","Category 1")
		
	);
	$ghsTranslate = array(
		//Physical Hazards
		"H200"=>"Unstable explosive",
		"H201"=>"Explosive; mass explosion hazard",
		"H202"=>"Explosive; severe projection hazard",
		"H203"=>"Explosive; fire, blast or projection hazard",
		"H204"=>"Fire or projection hazard",
		"H205"=>"May mass explode in fire",
		"H206"=>"Fire, blast or projection hazard: increased risk of explosion if desensitizing agent is reduced",
		"H207"=>"Fire or projection hazard: increased risk of explosion if desensitizing agent is reduced",
		"H207(Warning)"=>"Fire or projection hazard: increased risk of explosion if desensitizing agent is reduced *Warning*",
		"H207(Danger)"=>"Fire or projection hazard: increased risk of explosion if desensitizing agent is reduced *Danger*",
		"H208"=>"Fire hazard: increased risk of explosion if desensitizing agent is reduced",
		"H220"=>"Extremely flammable gas",
		"H221"=>"Flammable gas",
		"H222"=>"Extremely flammable aerosol",
		"H223"=>"Flammable aerosol",
		"H224"=>"Extremely flammable liquid and vapour",
		"H225"=>"Highly flammable liquid and vapour",
		"H226"=>"Flammable liquid and vapour",
		"H227"=>"Combustible liquid",
		"H228"=>"Flammable solid",
		"H228(Warning)"=>"Flammable solid *Warning*",
		"H228(Danger)"=>"Flammable solid *Danger*",
		"H229"=>"Pressurized container: may burst if heated",
		"H230"=>"May react explosively even in the absence of air",
		"H231"=>"May react explosively even in the absence of air at elevated pressure and/or temperature",
		"H232"=>"May ignite spontaneously if exposed to air",
		"H240"=>"Heating may cause an explosion",
		"H241"=>"Heating may cause a fire or explosion",
		"H242"=>"Heating may cause a fire",
		"H242(Warning)"=>"Heating may cause a fire *Warning*",
		"H242(Danger)"=>"Heating may cause a fire *Danger*",
		"H250"=>"Catches fire spontaneously if exposed to air",
		"H251"=>"Self-heating; may catch fire",
		"H252"=>"Self-heating in large quantities; may catch fire",
		"H260"=>"In contact with water releases flammable gases which may ignite spontaneously",
		"H261"=>"In contact with water releases flammable gas",
		"H261(Warning)"=>"In contact with water releases flammable gas *Warning*",
		"H261(Danger)"=>"In contact with water releases flammable gas *Danger*",
		"H270"=>"May cause or intensify fire; oxidizer",
		"H271"=>"May cause fire or explosion; strong oxidizer",
		"H272"=>"May intensify fire; oxidizer",
		"H272(Warning)"=>"May intensify fire; oxidizer *Warning*",
		"H272(Danger)"=>"May intensify fire; oxidizer *Danger*",
		"H280"=>"Contains gas under pressure; may explode if heated",
		"H280(Liquefied gas)"=>"Contains gas under pressure; may explode if heated *Liquefied gas*",
		"H280(Compressed gas)"=>"Contains gas under pressure; may explode if heated *Compressed gas*",
		"H280(Dissolved gas)"=>"Contains gas under pressure; may explode if heated *Dissolved gas*",
		"H281"=>"Contains refrigerated gas; may cause cryogenic burns or injury",
		"H290"=>"May be corrosive to metals",

		//Health Hazards
		"H300"=>"Fatal if swallowed.",
		"H301"=>"Toxic if swallowed",
		"H302"=>"Harmful if swallowed",
		"H303"=>"May be harmful if swallowed",
		"H304"=>"May be fatal if swallowed and enters airways",
		"H305"=>"May be harmful if swallowed and enters airways",
		"H310"=>"Fatal in contact with skin",
		"H311"=>"Toxic in contact with skin",
		"H312"=>"Harmful in contact with skin",
		"H313"=>"May be harmful in contact with skin",
		"H314"=>"Causes severe skin burns and eye damage",
		"H315"=>"Causes skin irritation",
		"H316"=>"Causes mild skin irritation",
		"H317"=>"May cause an allergic skin reaction",
		"H318"=>"Causes serious eye damage",
		"H319"=>"Causes serious eye irritation",
		"H320"=>"Causes eye irritation",
		"H330"=>"Fatal if inhaled",
		"H331"=>"Toxic if inhaled",
		"H332"=>"Harmful if inhaled",
		"H333"=>"May be harmful if inhaled",
		"H334"=>"May cause allergy or asthma symptoms or breathing difficulties if inhaled",
		"H335"=>"May cause respiratory irritation",
		"H336"=>"May cause drowsiness or dizziness",
		"H340"=>"May cause genetic defects",
		"H341"=>"Suspected of causing genetic defects",
		"H350"=>"May cause cancer",
		"H351"=>"Suspected of causing cancer",
		"H360"=>"May damage fertility or the unborn child",
		"H361"=>"Suspected of damaging fertility or the unborn child",
		"H361D"=>"Suspected of damaging the unborn child",
		"H360D"=>"May damage the unborn child",
		"H361F"=>"Suspected of damaging fertility",
		"H360F"=>"May damage fertility",
		"H362"=>"May cause harm to breast-fed children",
		"H370"=>"Causes damage to organs",
		"H371"=>"May cause damage to organs",
		"H372"=>"Causes damage to organs through prolonged or repeated exposure",
		"H373"=>"May cause damage to organs through prolonged or repeated exposure",

		//Environmental Hazards
		"H400"=>"Very toxic to aquatic life",
		"H401"=>"Toxic to aquatic life",
		"H402"=>"Harmful to aquatic life",
		"H410"=>"Very toxic to aquatic life with long-lasting effects",
		"H411"=>"Toxic to aquatic life with long-lasting effects",
		"H412"=>"Harmful to aquatic life with long-lasting effects",
		"H413"=>"May cause long-lasting harmful effects to aquatic life",
		"H420"=>"Harms public health and the environment by destroying ozone in the upper atmosphere",
		"H433"=>"Harmful to terrestrial vertebrates"
		
	);

	
    $registrationOptionalFields = array(
        "supplier"

    );

	$registrationProhibitedFields = array(
		"location",
		"ngvppm",
		"ngvmgm3",
		"kgvppm",
		"kgvmgm3",
		"gvar",
		"rules",
        "haz_stat",
		"haz_urls",
		"haz_time"
	);

	$extrapolationFields = array(
		"ngvppm",
		"ngvmgm3",
		"kgvppm",
		"kgvmgm3",
		"gvar",
		"rules"
	);

	$gransvardeTypes = array(
		"ngvppm",
		"ngvmgm3",
		"kgvppm",
		"kgvmgm3"
	);


	$prettyFields = array(
		"id"=>"ID",
		"cas"=>"CAS",
		"name"=>"Name",
		"size"=>"Size",
		"supplier"=>"Supplier",
		"home"=>"Home Location",
		"location"=>"Current Location",
		"haz_stat"=>"Hazard Statements",
		"ngvppm"=>"Nivågränsvärde (PPM)",
		"ngvmgm3"=>"Nivågränsvärde (mg/m^3)",
		"kgvppm"=>"Korttidsgränsvärde (PPM)",
		"kgvmgm3"=>"Korttidsgränsvärde (mg/m^3)",
		"gvar"=>"År vid etablerade gränsvärden",
		"rules"=>"Särskilda Regler"
	);

	$notes = array(
		"A"=>"Ämnet har flera hygieniska gränsvärden, referera till arbetsmiljöverkets föreskrifter. (Lägsta värdet antaget)",
		"B"=>"Ämnet kan orsaka hörselskada. Exponering för ämnet nära det befintliga yrkeshygieniska gränsvärdet och vid samtidig exponering för buller nära insatsvärdet 80 dB kan orsaka hörselskada.",
		"C"=>"Ämnet är cancerframkallande.
Risk för cancer finns även vid annan exponering än via inandning. För vissa cancerframkallande ämnen som inte har gränsvärden gäller förbud eller tillståndskrav enligt föreskrifterna om kemiska arbetsmiljörisker.",
		"H"=>"Ämnet kan lätt upptas genom huden. Det föreskrivna gränsvärdet bedöms ge tillräckligt skydd enda stunder förutsättning att huden är skyddad mot exponering för ämnet ifråga",
		"M"=>"Medicinska kontroller. Medicinska kontroller kan krävas för hantering av ämnet. Se vidare föreskrifterna om medicinska kontroller i arbetslivet. För vissa ämnen ska arbetsgivaren erbjuda läkarundersökning och för andra ämnen gäller krav på periodisk läkarundersökning och tjänstbarhetsbedömning. Se föreskrifterna om kemiska arbetsmiljörisker och föreskrifterna om kvarts – stendamm i arbetsmiljön",
		"R"=>"Ämnet är reproduktionsstörande. Med reproduktionsstörande ämnen avses ämnen som kan medföra skadliga effekter på fortplantningsförmågan eller avkommans utveckling. Se även föreskrifterna om kemiska arbetsmiljörisker och om gravida och ammande arbetstagare",
		"S"=>"Ämnet är sensibiliserande. Sensibiliserande ämnen kan ge allergi eller annan överkänslighet. Överkänslighetsbesvären drabbar främst huden eller andningsorganen. Överkänslighet innebär att man reagerar vid kontakt med ämnen som normalt inte ger besvär. Allergi är en undergrupp av överkänslighet som orsakas av reaktioner i kroppens immunsystem. Särskilt låga gränsvärden har fastställts för ämnen med mer uttalat luftvägssensibiliserande egenskaper. Några ämnen med starkt sensibiliserande egenskaper får endast hanteras efter tillstånd från Arbetsmiljöverket, se föreskrifterna om kemiska arbetsmiljörisker. Dessa ämnen har inga gränsvärden men i vissa fall riktvärden",
		"V"=>"Vägledande korttidsgränsvärde. Vägledande korttidsgränsvärde ska användas som ett rekommenderat högsta värde som inte bör överskridas.",
		"1"=>"Ämnet får inte hanteras. Vissa undantag finns se vidare 45–46 §§ i föreskrifterna om kemiska arbetsmiljörisker om förbud och tillstånd, ämnen som tillhör grupp A i bilaga 1.",
		"2"=>"Korttidsgränsvärde som avser 5-minutersperiod gäller för ammoniak, diisocyanater, 2,6-diisopropylfenylisocyanat, fenylisocyanat, isocyansyra och metylisocyanat. Korttidsgränsvärde som avser 1-minuters-period gäller för akrylsyra.",
		"3"=>"Med inhalerbar fraktion menas den dammfraktion som definieras i svensk standard SS-EN 481, Arbetsplatsluft – Partikelstorleksfraktioner för mätning av luftburna partiklar, Utgåva 1, 1993, punkt 2.3 och som har en provtagningskaraktäristik enligt punkt 5.1. Med respirabel fraktion menas den dammfraktion som definieras i svensk standard SS-EN 481, Arbetsplatsluft - Partikelstorleksfraktioner för mätning av luftburna partiklar, Utgåva 1, 1993, punkt 2.11 och som har en provtagningskaraktäristik enligt punkt 5.3. Med totaldamm menas de partiklar (aerosoler) som fastnar på ett filter i den provtagare som beskrivs i Metodserien, Provtagning av totaldamm och respirabelt damm, Metod nr 1010, Arbetarskyddsstyrelsen, numera Arbetsmiljöverket. Filterdiametern är normalt 37 mm, men kan även vara 25 mm. Trots sitt namn provtas inte den totala mängden luftburna partiklar med denna metod. Se även Kommentarer till not 3 på sid 56.",
		"4"=>"För hantering av ämnet krävs tillstånd av Arbetsmiljöverket se vidare 47–48 §§ i föreskrifterna om kemiska arbetsmiljörisker om förbud och tillstånd, ämnen som tillhör grupp B i bilaga 1.",
		"5"=>"Det är troligt att gränsvärdet för kolmonoxid är dimensionerande vid exponering för avgaser från bensin- och gasoldrivna motorer, medan gränsvärdena för elementärt kol och kvävedioxid får motsvarande funktion för dieselavgaser. (AFS 2020:6)",
		"6"=>"Bensin, dieselolja, jetbränsle och villaolja/eldningsolja och andra petroleumbränslen har inga fastställda gränsvärden på grund av att de är blandningar av ett stort antal ämnen, vars halter oftast inte är kända i detalj. De varierar dessutom mellan olika bränslepartier. Nedan anges ungefärliga värden som kan användas i det förebyggande skyddsarbetet. För mätningar av kolväten kan man använda instrument som ger totalhalten av ämnena. Instrumentet ska kalibreras mot aktuellt bränsle eller t.ex. ren oktan. <table><tr><th>Produkt</th><th>Rekommenderade värden för totalhalt kolväten i luft, mg/m3 (tidsvägt medelvärde för en arbetsdag)</th></tr><tr><td>Flygbensin</td><td>350</td></tr><tr><td>Motorbensin</td><td>250</td></tr><tr><td>Alkylatbensina</td><td>900</td></tr><tr><td>Jetbränsle</td><td>250</td></tr><tr><td>Diesel Mk1</td><td>350</td></tr><tr><td>Villaolja 250</td></tr></table><ol><li>Specialbensin för motordrivna arbetsredskap (svensk standard SS 155461:2008) t.ex. motorsågar.</li><li>Kallas också Jet A-1, flygfotogen m.m.</li><li>Diesel (Mk 2 och Mk 3) med högre aromathalter (max 20 och ca 25 %) finns också men har en begränsad marknad.</li></ol>",
		"7"=>"Gränsvärdet avser bensin som innehåller mindre än 0,2 % bensen.",
		"8"=>"Industribensin, extraktionsbensin, specificeras genom sitt kokpunktsintervall. Vanliga sorter i Sverige brukar innehålla antingen huvudsakligen hexaner (ca 25–50 % n-hexan, kokpunktsintervall ca 60–80 °C), heptaner (kokpunktsintervall ca 80–110 °C) eller oktaner (kokpunktsintervall ca 100–140 °C). Jämför n-hexan, övriga hexaner, heptaner och oktaner.",
		"9"=>"Gränsvärdet avser bensin som innehåller mindre än 5 % n-hexan. ",
		"10"=>"p-Bensokinon, kinon, kan genom reduktion övergå till hydrokinon. Hydrokinon kan lätt återbildas till p-bensokinon genom luftoxidation. Se även hydrokinon.",
		"11"=>"Benso(a)pyren kan förekomma bland andra polycykliska aromatiska kolväten (PAH) i rök, damm eller dimma från t.ex. tjära och asfalt samt i vissa oljor och förbränningsprodukter.",
		"12"=>"För de ftalater som inte har ämnesspecifika gränsvärden gäller gränsvärdet för ftalater uttryckt i mg/m3 .",
		"13"=>"Ämnen som har tagits upp på bilaga XIV (tillstånd) till REACH och kräver tillstånd för att få användas och släppas ut på marknaden (1 dec 2017). För aktuell lista se Echas hemsida.",
		"14"=>"För bly och kadmium finns biologiska gränsvärden, se föreskrifterna om medicinska kontroller i arbetslivet. Även kvicksilver kan mätas biolgiskt.",
		"15"=>"Samma gränsvärde uttryckt i ppm ska tillämpas för de laktater som inte har fastställda gränsvärden.",
		"16"=>"För damm eller dimma av ämnen som har särskilda gränsvärden tilllämpas dessa värden.",
		"17"=>"Avser damm från sluthärdad eller nästan sluthärdad epoxi-, akrylat-, polyuretan- och esterplast, bakelit eller dylikt. Hit räknas även damm från ohärdat pulvermaterial av epoxityp m.fl.",
		"18"=>"Vid bedömning av damm från tryckimpregnerat virke tillämpas gränsvärdet 0,5 mg/m3.",
		"19"=>"Gränsvärdet avser kolväten i ångform dvs. upp till 12 kolatomer. Vid exponering för kolväten med mer än 12 kolatomer som förekommer i form av aerosol, partiklar eller vätskedroppar, tillämpas gränsvärdet för organiskt damm och dimma, 5 mg/m3 . Gränsvärdet gäller inte för aromatfri lacknafta (< 2 viktsprocent) som har eget gränsvärde, se not 36.",
		"20"=>"Samma gränsvärde uttryckt i ppm ska tillämpas även för de diisocyanater som inte har fastställda gränsvärden. På gränsvärdeslistan finns följande diisocyanater upptagna: <ol><li>Hexametylendiisocyanat, HDI</li><li>Isoforondiisocyanat, IPDI</li><li>4,4-Metylendifenyldiisocyanat, MDI</li><li>Naftalendiisocyanat, NDI</li><li>Toluendiisocyanat, TDI</li><li>Trimetylhexametylendiisocyanat, TMDI</ol>",
		"21"=>"Exponering för monoisocyanater vid termisk nedbrytning av polyuretan omfattas av medicinska kontroller med tjänstbarhetsbedömning. På gränsvärdeslistan finns följande monoisocyanater upptagna: <ol><li>2,6-Diisopropylfenylisocyanat</li><li>Fenylisocyanat</li><li>Isocyansyra, ICA</li><li>Metylisocyanat, MIC</ol>",
		"22"=>"I ångform kan ämnet i betydande grad upptas genom huden. ",
		"23"=>"Nivågränsvärdet 1 ppm gäller för summan av halterna av dimetyldisulfid, dimetylsulfid och metantiol.",
		"24"=>"Upptaget av ämnet i vätskeform genom huden är så stort att det kan ge livshotande skador.",
		"25"=>"Gränsvärdet gäller för subtilisin och liknande proteolytiska enzymer. En glycinenhet motsvarar en aktivitet som från standardsubstrat under standardbetingelser frigör så många aminogrupper som finns i 1 mg glycin.",
		"26"=>"Gränsvärdet gäller den sammanlagda koncentrationen av ånga och aerosol.",
		"27"=>"Med hänsyn till risken för reproduktionsstörande verkan och till det stora upptaget via hud av såväl vätska som ånga är det särskilt viktigt att undvika hudkontakt. Vid samtidig exponering för flera lösningsmedel ska den hygieniska effekten för reproduktionsstörande etylenglykletrar och andra lösningsmedel beräknas separat, se föreskrifterna om kemiska arbetsmiljörisker. Etylenglykoletrarnas bidrag till annan lösningsmedelspåverkan än reproduktionsstörande verkan kan försummas. Några av dessa kräver tillstånd av Arbetsmiljöverket för hantering. Se vidare föreskrifterna om kemiska arbetsmiljörisker.",
		"28"=>"De fibrer som man tar hänsyn till vid jämförelse med gränsvärdet är sådana respirabla fibrer, som har ett längdbreddförhållande större än 3:1, en diameter mindre än 3 µm och en längd större än 5 µm. Gränsvärdet förutsätter att fiberräkningen utförs i faskontrastmikroskop. Vid exponering för fiberhaltigt damm gäller också gränsvärdet för oorganiskt damm.",
		"29"=>"Bland mineral som kan förekomma som naturligt kristallina fibrer kan nämnas attapulgit, halloysit, sepiolit och wollastonit.",
		"30"=>"Vanligaste eldfasta keramiska fibrerna är aluminiumsilikatfibrer (CASnr: 142844-00-6).",
		"31"=>"Vid exponering för blandningar av fluorider och vätefluorid ska nivågränsvärdet för fluorider tillämpas.",
		"32"=>"För att få tillstånd för hantering av hexahydroftalsyraanhydrid, metylhexahydroftalsyraanhydrid, metyltetrahydroftalsyraanhydrid, tetrahydroftalsyraanhydrid eller tetraklorftalsyraanhydrid bör ett riktvärde på 0,005 mg/m3 för den sammanlagda exponeringen för syraanhydrider under 15 minuter inte överskridas.",
		"33"=>"Metylisocyanat och isocyansyra kan bildas vid heta arbeten i polyuretan och andra kväveinnehållande kolföreningar. Krav på medicinsk kontroll gäller endast när ämnet bildas vid sådan termisk nedbrytning av material som anges i föreskrifterna om kemiska arbetsmiljörisker.",
		"34"=>"Koldioxid används ofta som indikatorsubstans i arbetslokaler där luftföroreningar huvudsakligen uppkommer genom de personer som vistas där. Se särskilda regler om ventilation i föreskrifterna om arbetsplatsens utformning",
		"35"=>"När det gäller underjord- eller tunnelarbete träder gränsvärdena för kolmonoxid, kvävedioxid och kvävemonoxid i kraft först 21 augusti 2023. Fram till dess gällergränsvärden enligt följande: <table><tr><th>Ämne</th><th>Nivågränsvärde</th><th></th><th>Korttidsgränsvärde</th><th></th><th>Anm.</th></tr><tr><td></td><td>ppm</td><td>mg/m3</td><td>ppm</td><td>mg/m3</td><td></td></tr><tr><td>Kvävemonoxid</td><td>25</td><td>30</td><td>50</td><td>60</td><td>V</td></tr><tr><td>Kvävedioxid</td><td>1</td><td>2</td><td>5</td><td>10</td><td>V</td></tr><tr><td>Kolmonoxid</td><td>20</td><td>25</td><td>100</td><td>117</td><td>B,R,V</td></tr></table>",
		"36"=>"Avser lacknafta som företrädesvis används som lösnings- och spädningsmedel för färg- och lackprodukter, dvs. petroleumnafta med sina huvudsakliga beståndsdelar i området C7 till C12 och med upp till 22 viktprocent aromater (upp till ca 20 volymprocent) och mindre än 0,1 viktprocent bensen. Jämför not 39 om petroleumnafta. Angivet ungefärligt värde uttryckt i ppm är beräknat på lacknafta med 22 viktprocent aromater.",
		"37"=>"Metylenklorid är även reglerade av Kemikalieinspektionens lagstiftning. Dispens krävsför att saluhålla, överlåta och använda metylenklorid yrkesmässigt i Sverige undantaget forskning, utveckling och analysarbete.",
		"38"=>"Vissa oljor ger vid upphettning upphov till polycykliska aromatiska kolväten (PAH) som kan vara cancerframkallande. Dessutom kan mineraloljor i sig innehålla sådana ämnen.",
		"39"=>"Om oljan används som skärvätska eller vid användninga av vattenhaltig skärvätska se not 43 om skärvätska.",
		"40"=>"Petroleumnafta består av en blandning av s.k. petroleumkolväten, vanligen med kokpunktsintervall 135-200 o C. Beteckningar som aromatnafta och alifatnafta kan förekomma för petroleumnafta med nära 100 % aromater eller nära 100 % alifater. Lacknafta med 17-22 % aromater är en typ av petroleumnafta. Särskilt gränsvärde gäller för lacknafta med en aromathalt upp till 22 viktprocent (se även not 36). Gränsvärden för annan typ av petroleumnafta beräknas med utgångspunkt från sammansättning och gränsvärden för ingående komponenter.",
		"41"=>"Med underjordsarbete avses berg- och gruvarbete, byggnadsarbete och liknande arbete under jord samt tillfälligt arbete i lokaler, bergrum, tunnlar och liknade under jord. Vid dessa arbeten gäller gränsvärdet för radon som totalexponering under ett år och får inte överstiga 2,1 x 106 Bq h/m3 (årsarbetstid = 1600 h). Detta värde motsvarar en exponering på ca 1300 Bq/m3 . För övrigt underjordsarbete, såsom arbete i färdigställda och inredda bergrum och berganläggningar, källarlokaler och liknande, gäller gränsvärdet för radon som totalexponering under ett år och får inte överstiga 0,72 x 106 Bq h/m3 (årsarbetstid = 1800 h). Detta värde motsvarar en exponering på ca 400 Bq/m3 . Bestämning av radonhalt bör ske enligt Strålsäkerhetsmyndighetens Metodbeskrivning för mätning av radon på arbetsplatser. Om radonhalten vid all typ av underjordsarbete överskrider 200 Bq/m3 ska verksamheten anmälas till Strålsäkerhetsmyndigheten, se Strålsäkerhetsmyndighetens föreskrifter om anmälningspliktiga verksamheter. I dessa fall är Strålsäkerhetsmyndigheten tillsynsmyndighet.",
		"42"=>"För annat arbete, än underjordsarbete, anges gränsvärdet för radon som totalexponering under ett år och får inte överstiga 0,36 x 106 Bq h/m3 (årsarbetstid = 1800 h). Detta värde motsvarar en exponering på ca 200 Bq/m3 . Bestämning av radonhalt bör ske enligt Strålsäkerhetsmyndighetens Metodbeskrivning för mätning av radon på arbetsplatser. Om radonhalten överskrider 200 Bq/m3 ska verksamheten anmälas till Strålsäkerhetsmyndigheten, se Strålsäkerhetsmyndighetens föreskrifter om anmälningspliktiga verksamheter. I dessa fall är Strålsäkerhetsmyndigheten tillsynsmyndighet.",
		"43"=>"Skärvätskor utgör en heterogen grupp av blandningar med olika sammansättning (från rena mineraloljor till helt vattenbaserade) och med olika tillsatser. Sammansättningen kan påverkas under användningen. Skärvätskor kan ge upphov till ögonirritation och luftvägsbesvär. För att skydda mot dessa effekter bör ett riktvärde på på 0,2 mg/m3 mätt som inhalerbar fraktion för den sammanlagda exponeringen för skärvätskor under 8 timmar inte överskridas.",
		"44"=>"Gränsvärdet gäller inte sådana metallstearater som innehåller toxiska metaller, t.ex. bly. I detta fall ska gränsvärdet för bly användas.",
		"45"=>"Gränsvärdet skyddar inte astamtiker. Studier har visat att astmatiker inte reagerar på exponeringar av svaveldioxid under 0,2 ppm.",
		"46"=>"Aerosoler av svavelsyra har i studier visats vara cancerframkallande."
	);

	
	$unknownHazCodes=array_keys($obscuredHazCodes);
	$allHazCodes=array_merge($unknownHazCodes,array_keys($classAssoc));