
const multiChoice = {
		//Physical Hazards
		"H207" : ["Warning","Danger"],
		"H280" : ["Compressed gas","Liquefied gas","Dissolved gas"],
		"H228" : ["Warning","Danger"],
		"H242" : ["Warning","Danger"],
		"H261" : ["Warning","Danger"],
		"H272" : ["Warning","Danger"]
};

const classAssoc = {
		//Physical Hazards
		
		"H200" : ["Explosives","Unstable explosive"],
		"H201" : ["Explosives", "Division 1.1"],
		"H202" : ["Explosives", "Division 1.2"],
		"H203" : ["Explosives", "Division 1.3"],
		"H204" : ["Explosives", "Division 1.4"],
		"H205" : ["Explosives", "Division 1.5"],

		"H206" : ["Desensitized explosives", "Category 1"],
		"H207" : ["Desensitized explosives", {"Warning":"Category 3","Danger":"Category 2"}],
		"H207(Warning)" : ["Desensitized explosives", "Category 3"],
		"H207(Danger)" : ["Desensitized explosives", "Category 2"],
		"H208" : ["Desensitized explosives", "Category 4"],

		"H220" : ["Flammable gases","Category 1"],
		"H221" : ["Flammable gases","Category 2"],
		"H230" : ["Flammable gases","Category A"],
		"H231" : ["Flammable gases","Category B"],
		"H232" : ["Flammable gases","Category 1"],

		"H222" : ["Aerosol","Category 1"],
		"H223" : ["Aerosol","Category 2"],
		"H229" : ["Aerosol","Category 1"],

		"H270" : ["Oxidising gases","Category 1"],

		"H280" : ["Gases under pressure", {"Compressed gas":"Compressed gas","Liquefied gas":"Liquefied gas","Dissolved gas":"Dissolved gas"}],
		"H281" : ["Gases under pressure","Refrigerated liquefied gas"],

		"H224" : ["Flammable liquids","Category 1"],
		"H225" : ["Flammable liquids","Category 2"],
		"H226" : ["Flammable liquids","Category 3"],
		"H227" : ["Flammable liquids","Category 4"],

		"H228" : ["Flammable solids", {"Warning":"Category 2","Danger":"Category 1"}],

		"H240" : ["Self-reactive substances and mixtures/Organic Peroxides","Type A"],
		"H241" : ["Self-reactive substances and mixtures/Organic Peroxides","Type B"],
		"H242" : ["Self-reactive substances and mixtures/Organic Peroxides", {"Warning":"Type E&F","Danger":"Type C&D"}],

		"H250" : ["Pyrophoric liquid/solid","Category 1"],

		"H251" : ["Self-heating substances and mixtures","Category 1"],
		"H252" : ["Self-heating substances and mixtures","Category 2"],

		"H260" : ["Substances or mixtures which in contact with water emit flammable gases","Category 1"],
		"H261" : ["Substances or mixtures which in contact with water emit flammable gases", {"Warning":"Category 3","Danger":"Category 2"}],

		"H271" : ["Oxidising liquid/solid","Category 1"],
		"H272" : ["Oxidising liquid/solid", {"Warning":"Category 3","Danger":"Category 2"}],

		"H290" : ["Corrosive to metals","Category 1"],

		//Health Hazards
		"H300" : ["Acute toxicity, oral","Category 1&2"],
		"H301" : ["Acute toxicity, oral","Category 3"],
		"H302" : ["Acute toxicity, oral","Category 4"],
		"H303" : ["Acute toxicity, oral","Category 5"],

		"H310" : ["Acute toxicity, dermal","Category 1&2"],
		"H311" : ["Acute toxicity, dermal","Category 3"],
		"H312" : ["Acute toxicity, dermal","Category 4"],
		"H313" : ["Acute toxicity, dermal","Category 5"],

		"H330" : ["Acute toxicity, inhalation","Category 1&2"],
		"H331" : ["Acute toxicity inhalation","Category 3"],
		"H332" : ["Acute toxicity inhalation","Category 4"],
		"H333" : ["Acute toxicity inhalation","Category 5"],

		"H314" : ["Skin corrosion/irritation","Category 1"],
		"H315" : ["Skin corrosion/irritation","Category 2"],
		"H316" : ["Skin corrosion/irritation","Category 3"],

		"H318" : ["Serious eye damage/eye irritation","Category 1"],
		"H319" : ["Serious eye damage/eye irritation","Category 2A"],
		"H320" : ["Serious eye damage/eye irritation","Category 2B"],

		"H334" : ["Sensitisation of the respiratory tract","Category 1"],
		"H317" : ["Sensitisation of the skin","Category 1"],

		
		"H340" : ["Germ cell mutagenicity","Category 1"],
		"H341" : ["Germ cell mutagenicity","Category 2"],

		
		"H350" : ["Carcinogenicity","Category 1"],
		"H351" : ["Carcinogenicity","Category 2"],

		"H360" : ["Reproductive toxicity","Category 1"],
		"H360D" : ["Reproductive toxicity","Category 1"],
		"H360F" : ["Reproductive toxicity","Category 1"],
		"H361" : ["Reproductive toxicity","Category 2"],
		"H361D" : ["Reproductive toxicity","Category 2"],
		"H361F" : ["Reproductive toxicity","Category 2"],
		"H362" : ["Reproductive toxicity","Additional category"],


		"H370" : ["Specific target organ toxicity, single exposure","Category 1"],
		"H371" : ["Specific target organ toxicity, single exposure","Category 2"],
		"H335" : ["Specific target organ toxicity, single exposure","Category 3"],
		"H336" : ["Specific target organ toxicity, single exposure","Category 3"],


		"H372" : ["Specific target organ toxicity, repeated exposure","Category 1"],
		"H373" : ["Specific target organ toxicity, repeated exposure","Category 2"],

		"H304" : ["Aspiration toxicity","Category 1"],
		"H305" : ["Aspiration toxicity","Category 2"],

		//Environmental Hazards
		"H400" : ["Hazardous to the aquatic environment, acute hazard","Category 1"],
		"H401" : ["Hazardous to the aquatic environment, acute hazard","Category 2"],
		"H402" : ["Hazardous to the aquatic environment, acute hazard","Category 3"],

		"H410" : ["Hazardous to the aquatic environment, long-term hazard","Category 1"],
		"H411" : ["Hazardous to the aquatic environment, long-term hazard","Category 2"],
		"H412" : ["Hazardous to the aquatic environment, long-term hazard","Category 3"],
		"H413" : ["Hazardous to the aquatic environment, long-term hazard","Category 4"],

		"H420" : ["Hazardous to the ozone layer","Category 1"],


		"H433" : ["Harmful to terrestrial vertebrates",""]
		
};

const ghsList = {
	//Physical Hazards
	//NOTE!: Reduce to 1d-array
	"H200" : "Unstable explosive",
	"H201" : "Explosive; mass explosion hazard",
	"H202" : "Explosive; severe projection hazard",
	"H203" : "Explosive; fire, blast or projection hazard",
	"H204" : "Fire or projection hazard",
	"H205" : "May mass explode in fire",
	"H206" : "Fire, blast or projection hazard: increased risk of explosion if desensitizing agent is reduced",
	"H207" : "Fire or projection hazard: increased risk of explosion if desensitizing agent is reduced",
	"H208" : "Fire hazard: increased risk of explosion if desensitizing agent is reduced",
	"H220" : "Extremely flammable gas",
	"H221" : "Flammable gas",
	"H222" : "Extremely flammable aerosol",
	"H223" : "Flammable aerosol",
	"H224" : "Extremely flammable liquid and vapour",
	"H225" : "Highly flammable liquid and vapour",
	"H226" : "Flammable liquid and vapour",
	"H227" : "Combustible liquid",
	"H228" : "Flammable solid",
	"H229" : "Pressurized container: may burst if heated",
	"H230" : "May react explosively even in the absence of air",
	"H231" : "May react explosively even in the absence of air at elevated pressure and/or temperature",
	"H232" : "May ignite spontaneously if exposed to air",
	"H240" : "Heating may cause an explosion",
	"H241" : "Heating may cause a fire or explosion",
	"H242" : "Heating may cause a fire",
	"H250" : "Catches fire spontaneously if exposed to air",
	"H251" : "Self-heating; may catch fire",
	"H252" : "Self-heating in large quantities; may catch fire",
	"H260" : "In contact with water releases flammable gases which may ignite spontaneously",
	"H261" : "In contact with water releases flammable gas",
	"H270" : "May cause or intensify fire; oxidizer",
	"H271" : "May cause fire or explosion; strong oxidizer",
	"H272" : "May intensify fire; oxidizer",
	"H280" : "Contains gas under pressure; may explode if heated",
	"H281" : "Contains refrigerated gas; may cause cryogenic burns or injury",
	"H290" : "May be corrosive to metals",

	//Health Hazards
	"H300" : "Fatal if swallowed.",
	"H301" : "Toxic if swallowed",
	"H302" : "Harmful if swallowed",
	"H303" : "May be harmful if swallowed",
	"H304" : "May be fatal if swallowed and enters airways",
	"H305" : "May be harmful if swallowed and enters airways",
	"H310" : "Fatal in contact with skin",
	"H311" : "Toxic in contact with skin",
	"H312" : "Harmful in contact with skin",
	"H313" : "May be harmful in contact with skin",
	"H314" : "Causes severe skin burns and eye damage",
	"H315" : "Causes skin irritation",
	"H316" : "Causes mild skin irritation",
	"H317" : "May cause an allergic skin reaction",
	"H318" : "Causes serious eye damage",
	"H319" : "Causes serious eye irritation",
	"H320" : "Causes eye irritation",
	"H330" : "Fatal if inhaled",
	"H331" : "Toxic if inhaled",
	"H332" : "Harmful if inhaled",
	"H333" : "May be harmful if inhaled",
	"H334" : "May cause allergy or asthma symptoms or breathing difficulties if inhaled",
	"H335" : "May cause respiratory irritation",
	"H336" : "May cause drowsiness or dizziness",
	"H340" : "May cause genetic defects",
	"H341" : "Suspected of causing genetic defects",
	"H350" : "May cause cancer",
	"H351" : "Suspected of causing cancer",
	"H360" : "May damage fertility or the unborn child",
	"H361" : "Suspected of damaging fertility or the unborn child",
	"H361D" : "Suspected of damaging the unborn child",
	"H360D" : "May damage the unborn child",
	"H361F" : "Suspected of damaging fertility",
	"H360F" : "May damage fertility",
	"H362" : "May cause harm to breast-fed children",
	"H370" : "Causes damage to organs",
	"H371" : "May cause damage to organs",
	"H372" : "Causes damage to organs through prolonged or repeated exposure",
	"H373" : "May cause damage to organs through prolonged or repeated exposure",

	//Environmental Hazards
	"H400" : "Very toxic to aquatic life",
	"H401" : "Toxic to aquatic life",
	"H402" : "Harmful to aquatic life",
	"H410" : "Very toxic to aquatic life with long-lasting effects",
	"H411" : "Toxic to aquatic life with long-lasting effects",
	"H412" : "Harmful to aquatic life with long-lasting effects",
	"H413" : "May cause long-lasting harmful effects to aquatic life",
	"H420" : "Harms public health and the environment by destroying ozone in the upper atmosphere",
	"H433" : "Harmful to terrestrial vertebrates"
	
};

const notesList = {
		"A" : "Ämnet har flera hygieniska gränsvärden, referera till arbetsmiljöverkets föreskrifter. (Lägsta värdet antaget)",
		"B" : "Ämnet kan orsaka hörselskada. Exponering för ämnet nära det befintliga yrkeshygieniska gränsvärdet och vid samtidig exponering för buller nära insatsvärdet 80 dB kan orsaka hörselskada.",
		"C" : "Ämnet är cancerframkallande.Risk för cancer finns även vid annan exponering än via inandning. För vissa cancerframkallande ämnen som inte har gränsvärden gäller förbud eller tillståndskrav enligt föreskrifterna om kemiska arbetsmiljörisker.",
		"H" : "Ämnet kan lätt upptas genom huden. Det föreskrivna gränsvärdet bedöms ge tillräckligt skydd endastunder förutsättning att huden är skyddad mot exponering för ämnet ifråga",
		"M" : "Medicinska kontroller. Medicinska kontroller kan krävas för hantering av ämnet. Se vidare föreskrifterna om medicinska kontroller i arbetslivet. För vissa ämnen ska arbetsgivaren erbjuda läkarundersökning och för andra ämnen gäller krav på periodisk läkarundersökning och tjänstbarhetsbedömning. Se föreskrifterna om kemiska arbetsmiljörisker och föreskrifterna om kvarts – stendamm i arbetsmiljön",
		"R" : "Ämnet är reproduktionsstörande. Med reproduktionsstörande ämnen avses ämnen som kan medföra skadliga effekter på fortplantningsförmågan eller avkommans utveckling. Se även föreskrifterna om kemiska arbetsmiljörisker och om gravida och ammande arbetstagare",
		"S" : "Ämnet är sensibiliserande. Sensibiliserande ämnen kan ge allergi eller annan överkänslighet. Överkänslighetsbesvären drabbar främst huden eller andningsorganen. Överkänslighet innebär att man reagerar vid kontakt med ämnen som normalt inte ger besvär. Allergi är en undergrupp av överkänslighet som orsakas av reaktioner i kroppens immunsystem. Särskilt låga gränsvärden har fastställts för ämnen med mer uttalat luftvägssensibiliserande egenskaper. Några ämnen med starkt sensibiliserande egenskaper får endast hanteras efter tillstånd från Arbetsmiljöverket, se föreskrifterna om kemiska arbetsmiljörisker. Dessa ämnen har inga gränsvärden men i vissa fall riktvärden",
		"V" : "Vägledande korttidsgränsvärde. Vägledande korttidsgränsvärde ska användas som ett rekommenderat högsta värde som inte bör överskridas.",
		"1" : "Ämnet får inte hanteras. Vissa undantag finns se vidare 45–46 §§ i föreskrifterna om kemiska arbetsmiljörisker om förbud och tillstånd, ämnen som tillhör grupp A i bilaga 1.",
		"2" : "Korttidsgränsvärde som avser 5-minutersperiod gäller för ammoniak, diisocyanater, 2,6-diisopropylfenylisocyanat, fenylisocyanat, isocyansyra och metylisocyanat. Korttidsgränsvärde som avser 1-minuters-period gäller för akrylsyra.",
		"3" : "Med inhalerbar fraktion menas den dammfraktion som definieras i svensk standard SS-EN 481, Arbetsplatsluft – Partikelstorleksfraktioner för mätning av luftburna partiklar, Utgåva 1, 1993, punkt 2.3 och som har en provtagningskaraktäristik enligt punkt 5.1. Med respirabel fraktion menas den dammfraktion som definieras i svensk standard SS-EN 481, Arbetsplatsluft - Partikelstorleksfraktioner för mätning av luftburna partiklar, Utgåva 1, 1993, punkt 2.11 och som har en provtagningskaraktäristik enligt punkt 5.3. Med totaldamm menas de partiklar (aerosoler) som fastnar på ett filter i den provtagare som beskrivs i Metodserien, Provtagning av totaldamm och respirabelt damm, Metod nr 1010, Arbetarskyddsstyrelsen, numera Arbetsmiljöverket. Filterdiametern är normalt 37 mm, men kan även vara 25 mm. Trots sitt namn provtas inte den totala mängden luftburna partiklar med denna metod. Se även Kommentarer till not 3 på sid 56.",
		"4" : "För hantering av ämnet krävs tillstånd av Arbetsmiljöverket se vidare 47–48 §§ i föreskrifterna om kemiska arbetsmiljörisker om förbud och tillstånd, ämnen som tillhör grupp B i bilaga 1.",
		"5" : "Det är troligt att gränsvärdet för kolmonoxid är dimensionerande vid exponering för avgaser från bensin- och gasoldrivna motorer, medan gränsvärdena för elementärt kol och kvävedioxid får motsvarande funktion för dieselavgaser. (AFS 2020:6)",
		"6" : "Bensin, dieselolja, jetbränsle och villaolja/eldningsolja och andra petroleumbränslen har inga fastställda gränsvärden på grund av att de är blandningar av ett stort antal ämnen, vars halter oftast inte är kända i detalj. De varierar dessutom mellan olika bränslepartier. Nedan anges ungefärliga värden som kan användas i det förebyggande skyddsarbetet. För mätningar av kolväten kan man använda instrument som ger totalhalten av ämnena. Instrumentet ska kalibreras mot aktuellt bränsle eller t.ex. ren oktan. <table><tr><th>Produkt</th><th>Rekommenderade värden för totalhalt kolväten i luft, mg/m3 (tidsvägt medelvärde för en arbetsdag)</th></tr><tr><td>Flygbensin</td><td>350</td></tr><tr><td>Motorbensin</td><td>250</td></tr><tr><td>Alkylatbensina</td><td>900</td></tr><tr><td>Jetbränsle</td><td>250</td></tr><tr><td>Diesel Mk1</td><td>350</td></tr><tr><td>Villaolja 250</td></tr></table><ol><li>Specialbensin för motordrivna arbetsredskap (svensk standard SS 155461:2008) t.ex. motorsågar.</li><li>Kallas också Jet A-1, flygfotogen m.m.</li><li>Diesel (Mk 2 och Mk 3) med högre aromathalter (max 20 och ca 25 %) finns också men har en begränsad marknad.</li></ol>",
		"7" : "Gränsvärdet avser bensin som innehåller mindre än 0,2 % bensen.",
		"8" : "Industribensin, extraktionsbensin, specificeras genom sitt kokpunktsintervall. Vanliga sorter i Sverige brukar innehålla antingen huvudsakligen hexaner (ca 25–50 % n-hexan, kokpunktsintervall ca 60–80 °C), heptaner (kokpunktsintervall ca 80–110 °C) eller oktaner (kokpunktsintervall ca 100–140 °C). Jämför n-hexan, övriga hexaner, heptaner och oktaner.",
		"9" : "Gränsvärdet avser bensin som innehåller mindre än 5 % n-hexan. ",
		"10" : "p-Bensokinon, kinon, kan genom reduktion övergå till hydrokinon. Hydrokinon kan lätt återbildas till p-bensokinon genom luftoxidation. Se även hydrokinon.",
		"11" : "Benso(a)pyren kan förekomma bland andra polycykliska aromatiska kolväten (PAH) i rök, damm eller dimma från t.ex. tjära och asfalt samt i vissa oljor och förbränningsprodukter.",
		"12" : "För de ftalater som inte har ämnesspecifika gränsvärden gäller gränsvärdet för ftalater uttryckt i mg/m3 .",
		"13" : "Ämnen som har tagits upp på bilaga XIV (tillstånd) till REACH och kräver tillstånd för att få användas och släppas ut på marknaden (1 dec 2017). För aktuell lista se Echas hemsida.",
		"14" : "För bly och kadmium finns biologiska gränsvärden, se föreskrifterna om medicinska kontroller i arbetslivet. Även kvicksilver kan mätas biolgiskt.",
		"15" : "Samma gränsvärde uttryckt i ppm ska tillämpas för de laktater som inte har fastställda gränsvärden.",
		"16" : "För damm eller dimma av ämnen som har särskilda gränsvärden tilllämpas dessa värden.",
		"17" : "Avser damm från sluthärdad eller nästan sluthärdad epoxi-, akrylat-, polyuretan- och esterplast, bakelit eller dylikt. Hit räknas även damm från ohärdat pulvermaterial av epoxityp m.fl.",
		"18" : "Vid bedömning av damm från tryckimpregnerat virke tillämpas gränsvärdet 0,5 mg/m3.",
		"19" : "Gränsvärdet avser kolväten i ångform dvs. upp till 12 kolatomer. Vid exponering för kolväten med mer än 12 kolatomer som förekommer i form av aerosol, partiklar eller vätskedroppar, tillämpas gränsvärdet för organiskt damm och dimma, 5 mg/m3 . Gränsvärdet gäller inte för aromatfri lacknafta (< 2 viktsprocent) som har eget gränsvärde, se not 36.",
		"20" : "Samma gränsvärde uttryckt i ppm ska tillämpas även för de diisocyanater som inte har fastställda gränsvärden. På gränsvärdeslistan finns följande diisocyanater upptagna: <ol><li>Hexametylendiisocyanat, HDI</li><li>Isoforondiisocyanat, IPDI</li><li>4,4-Metylendifenyldiisocyanat, MDI</li><li>Naftalendiisocyanat, NDI</li><li>Toluendiisocyanat, TDI</li><li>Trimetylhexametylendiisocyanat, TMDI</ol>",
		"21" : "Exponering för monoisocyanater vid termisk nedbrytning av polyuretan omfattas av medicinska kontroller med tjänstbarhetsbedömning. På gränsvärdeslistan finns följande monoisocyanater upptagna: <ol><li>2,6-Diisopropylfenylisocyanat</li><li>Fenylisocyanat</li><li>Isocyansyra, ICA</li><li>Metylisocyanat, MIC</ol>",
		"22" : "I ångform kan ämnet i betydande grad upptas genom huden. ",
		"23" : "Nivågränsvärdet 1 ppm gäller för summan av halterna av dimetyldisulfid, dimetylsulfid och metantiol.",
		"24" : "Upptaget av ämnet i vätskeform genom huden är så stort att det kan ge livshotande skador.",
		"25" : "Gränsvärdet gäller för subtilisin och liknande proteolytiska enzymer. En glycinenhet motsvarar en aktivitet som från standardsubstrat under standardbetingelser frigör så många aminogrupper som finns i 1 mg glycin.",
		"26" : "Gränsvärdet gäller den sammanlagda koncentrationen av ånga och aerosol.",
		"27" : "Med hänsyn till risken för reproduktionsstörande verkan och till det stora upptaget via hud av såväl vätska som ånga är det särskilt viktigt att undvika hudkontakt. Vid samtidig exponering för flera lösningsmedel ska den hygieniska effekten för reproduktionsstörande etylenglykletrar och andra lösningsmedel beräknas separat, se föreskrifterna om kemiska arbetsmiljörisker. Etylenglykoletrarnas bidrag till annan lösningsmedelspåverkan än reproduktionsstörande verkan kan försummas. Några av dessa kräver tillstånd av Arbetsmiljöverket för hantering. Se vidare föreskrifterna om kemiska arbetsmiljörisker.",
		"28" : "De fibrer som man tar hänsyn till vid jämförelse med gränsvärdet är sådana respirabla fibrer, som har ett längdbreddförhållande större än 3:1, en diameter mindre än 3 µm och en längd större än 5 µm. Gränsvärdet förutsätter att fiberräkningen utförs i faskontrastmikroskop. Vid exponering för fiberhaltigt damm gäller också gränsvärdet för oorganiskt damm.",
		"29" : "Bland mineral som kan förekomma som naturligt kristallina fibrer kan nämnas attapulgit, halloysit, sepiolit och wollastonit.",
		"30" : "Vanligaste eldfasta keramiska fibrerna är aluminiumsilikatfibrer (CASnr: 142844-00-6).",
		"31" : "Vid exponering för blandningar av fluorider och vätefluorid ska nivågränsvärdet för fluorider tillämpas.",
		"32" : "För att få tillstånd för hantering av hexahydroftalsyraanhydrid, metylhexahydroftalsyraanhydrid, metyltetrahydroftalsyraanhydrid, tetrahydroftalsyraanhydrid eller tetraklorftalsyraanhydrid bör ett riktvärde på 0,005 mg/m3 för den sammanlagda exponeringen för syraanhydrider under 15 minuter inte överskridas.",
		"33" : "Metylisocyanat och isocyansyra kan bildas vid heta arbeten i polyuretan och andra kväveinnehållande kolföreningar. Krav på medicinsk kontroll gäller endast när ämnet bildas vid sådan termisk nedbrytning av material som anges i föreskrifterna om kemiska arbetsmiljörisker.",
		"34" : "Koldioxid används ofta som indikatorsubstans i arbetslokaler där luftföroreningar huvudsakligen uppkommer genom de personer som vistas där. Se särskilda regler om ventilation i föreskrifterna om arbetsplatsens utformning",
		"35" : "När det gäller underjord- eller tunnelarbete träder gränsvärdena för kolmonoxid, kvävedioxid och kvävemonoxid i kraft först 21 augusti 2023. Fram till dess gällergränsvärden enligt följande: <table><tr><th>Ämne</th><th>Nivågränsvärde</th><th>Korttidsgränsvärde</th><th>Anm.</th></tr><tr><td></td><td>ppm</td><td>mg/m3</td><td>ppm</td><td>mg/m3</td><td></td></tr><tr><td>Kvävemonoxid</td><td>25</td><td>30</td><td>50</td><td>60</td><td>V</td></tr><tr><td>Kvävedioxid/td><td>1/td><td>2/td><td>5/td><td>10/td><td>V</td></tr><tr><td>Kolmonoxid 20 25 100 117 B,R,V</td></tr></table",
		"36" : "Avser lacknafta som företrädesvis används som lösnings- och spädningsmedel för färg- och lackprodukter, dvs. petroleumnafta med sina huvudsakliga beståndsdelar i området C7 till C12 och med upp till 22 viktprocent aromater (upp till ca 20 volymprocent) och mindre än 0,1 viktprocent bensen. Jämför not 39 om petroleumnafta. Angivet ungefärligt värde uttryckt i ppm är beräknat på lacknafta med 22 viktprocent aromater.",
		"37" : "Metylenklorid är även reglerade av Kemikalieinspektionens lagstiftning. Dispens krävsför att saluhålla, överlåta och använda metylenklorid yrkesmässigt i Sverige undantaget forskning, utveckling och analysarbete.",
		"38" : "Vissa oljor ger vid upphettning upphov till polycykliska aromatiska kolväten (PAH) som kan vara cancerframkallande. Dessutom kan mineraloljor i sig innehålla sådana ämnen.",
		"39" : "Om oljan används som skärvätska eller vid användninga av vattenhaltig skärvätska se not 43 om skärvätska.",
		"40" : "Petroleumnafta består av en blandning av s.k. petroleumkolväten, vanligen med kokpunktsintervall 135-200 o C. Beteckningar som aromatnafta och alifatnafta kan förekomma för petroleumnafta med nära 100 % aromater eller nära 100 % alifater. Lacknafta med 17-22 % aromater är en typ av petroleumnafta. Särskilt gränsvärde gäller för lacknafta med en aromathalt upp till 22 viktprocent (se även not 36). Gränsvärden för annan typ av petroleumnafta beräknas med utgångspunkt från sammansättning och gränsvärden för ingående komponenter.",
		"41" : "Med underjordsarbete avses berg- och gruvarbete, byggnadsarbete och liknande arbete under jord samt tillfälligt arbete i lokaler, bergrum, tunnlar och liknade under jord. Vid dessa arbeten gäller gränsvärdet för radon som totalexponering under ett år och får inte överstiga 2,1 x 106 Bq h/m3 (årsarbetstid = 1600 h). Detta värde motsvarar en exponering på ca 1300 Bq/m3 . För övrigt underjordsarbete, såsom arbete i färdigställda och inredda bergrum och berganläggningar, källarlokaler och liknande, gäller gränsvärdet för radon som totalexponering under ett år och får inte överstiga 0,72 x 106 Bq h/m3 (årsarbetstid = 1800 h). Detta värde motsvarar en exponering på ca 400 Bq/m3 . Bestämning av radonhalt bör ske enligt Strålsäkerhetsmyndighetens Metodbeskrivning för mätning av radon på arbetsplatser. Om radonhalten vid all typ av underjordsarbete överskrider 200 Bq/m3 ska verksamheten anmälas till Strålsäkerhetsmyndigheten, se Strålsäkerhetsmyndighetens föreskrifter om anmälningspliktiga verksamheter. I dessa fall är Strålsäkerhetsmyndigheten tillsynsmyndighet.",
		"42" : "För annat arbete, än underjordsarbete, anges gränsvärdet för radon som totalexponering under ett år och får inte överstiga 0,36 x 106 Bq h/m3 (årsarbetstid = 1800 h). Detta värde motsvarar en exponering på ca 200 Bq/m3 . Bestämning av radonhalt bör ske enligt Strålsäkerhetsmyndighetens Metodbeskrivning för mätning av radon på arbetsplatser. Om radonhalten överskrider 200 Bq/m3 ska verksamheten anmälas till Strålsäkerhetsmyndigheten, se Strålsäkerhetsmyndighetens föreskrifter om anmälningspliktiga verksamheter. I dessa fall är Strålsäkerhetsmyndigheten tillsynsmyndighet.",
		"43" : "Skärvätskor utgör en heterogen grupp av blandningar med olika sammansättning (från rena mineraloljor till helt vattenbaserade) och med olika tillsatser. Sammansättningen kan påverkas under användningen. Skärvätskor kan ge upphov till ögonirritation och luftvägsbesvär. För att skydda mot dessa effekter bör ett riktvärde på på 0,2 mg/m3 mätt som inhalerbar fraktion för den sammanlagda exponeringen för skärvätskor under 8 timmar inte överskridas.",
		"44" : "Gränsvärdet gäller inte sådana metallstearater som innehåller toxiska metaller, t.ex. bly. I detta fall ska gränsvärdet för bly användas.",
		"45" : "Gränsvärdet skyddar inte astamtiker. Studier har visat att astmatiker inte reagerar på exponeringar av svaveldioxid under 0,2 ppm.",
		"46" : "Aerosoler av svavelsyra har i studier visats vara cancerframkallande."
};



//jQuery-function for Hazard-statement-add-button on edit form
$("#editadd").on("click", function() {
	let code = ($(this).prev().val().toUpperCase());
	if (($(this).prev().attr("id"))=="haz_stat"){
		if (code in ghsList){
			$("<input value='"+code+"' type='text' name='value["+code+"][0]'>").appendTo(".added");
			$(this).prev().val("");
			$("form").submit();
		}
	} else if (($(this).prev().attr("id"))=="rules"){
		if (code in notesList){
			$("<input value='"+code+"' type='text' name='value[]'>").appendTo(".added");
			$(this).prev().val("");
			$("form").submit();
		}
	};
});
//----------------------------------//


//jQuery-function for Hazard-statement-add-button on edit form
$(".editrem").on("click",function(){
	$(this).parent().remove();
	$('form').submit();
});
//----------------------------------//

export function editsubmit(url){
	$("form").attr("action",url);
	$('form').submit();
};
//----------------------------------//



//Menu "buttons" redirect to corresponding site
$(".menu div").click(function() {
    window.location=("./sites/"+$(this).attr('id')+'.php');
});
//----------------------------------//

//Focus on input when loading edit page
$(document).ready(function() {
    $("#editbox").focus();
});
//----------------------------------//





//jQuery-Functions for clickable rows after query search
$(".clickableRow, .editRow").hover(function () {
	$(this).css('cursor', 'pointer');
  
}, function () {
	$(this).css('cursor', 'default');
});


$(".clickableRow").dblclick(function() {
window.location=("chemprofile.php?id="+$(this).attr("id"));
});
//----------------------------------//


//jQuery function for redirect when trying to edit row
$(".editRow").dblclick(function() {
	if ($(this).attr("id")=="home"){
		window.location=("chemprofile.php?id="+$("td:first-of-type").html()+"&edit="+$(this).attr("id")+"&placeholder="+$(this).find("td").text()+"");
	} else{
		window.location=("chemprofile.php?id="+$("td:first-of-type").html()+"&edit="+$(this).attr("id"));
	};
});
//----------------------------------//

//JS function for drawing chemical structure to canvas from cas
export function drawChemical(cas,id){

	var canvas = document.getElementById(id);
	var ctx = canvas.getContext('2d');
	canvas.width = 480;
	canvas.height = 360;
	var base_image = new Image();
	base_image.crossOrigin = "Anonymous";
	base_image.src = "https://n2s.openmolecules.org/?name="+cas;

	base_image.onload=function(){
		ctx.drawImage(base_image,0,0);
		var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
		var pixels = imageData.data;
		for(var i=0; i<pixels.length; i+=4) {
			if(isGrey(pixels[i], pixels[i+1], pixels[i+2])){
				pixels[i] = 255;
				pixels[i+1] = 225;
				pixels[i+2] = 240;
			};
		};
		ctx.putImageData(imageData, 0, 0);
		var trimmedCanvas=trimCanvas(canvas);

		canvas.height=trimmedCanvas.height;
		canvas.width=trimmedCanvas.width;
		ctx.drawImage(trimmedCanvas,0,0);
	};

	function isGrey(r, g, b) {
		if(r == 224 && g == 224 && b == 224) {
		return true;
		};
		return false;
	};
	
	function trimCanvas(c) {
		var ctx = c.getContext('2d'),
			copy = document.createElement('canvas').getContext('2d'),
			pixels = ctx.getImageData(0, 0, c.width, c.height),
			l = pixels.data.length,
			i,
			bound = {
				top: null,
				left: null,
				right: null,
				bottom: null
			},
			x, y;
		
		// Iterate over every pixel to find the highest
		// and where it ends on every axis ()
		for (i = 0; i < l; i += 4) {
			if (pixels.data[i + 3] !== 0) {
				x = (i / 4) % c.width;
				y = ~~((i / 4) / c.width);

				if (bound.top === null) {
					bound.top = y;
				}

				if (bound.left === null) {
					bound.left = x;
				} else if (x < bound.left) {
					bound.left = x;
				}

				if (bound.right === null) {
					bound.right = x;
				} else if (bound.right < x) {
					bound.right = x;
				}

				if (bound.bottom === null) {
					bound.bottom = y;
				} else if (bound.bottom < y) {
					bound.bottom = y;
				}
			}
		}
		
		// Calculate the height and width of the content
		var trimHeight = bound.bottom - bound.top,
			trimWidth = bound.right - bound.left,
			trimmed = ctx.getImageData(bound.left, bound.top, trimWidth, trimHeight);

		copy.canvas.width = trimWidth;
		copy.canvas.height = trimHeight;
		copy.putImageData(trimmed, 0, 0);

		// Return trimmed canvas
		return copy.canvas;
	}
};