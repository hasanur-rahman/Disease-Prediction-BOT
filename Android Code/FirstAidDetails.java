package com.example.user_pc.firstaid;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class FirstAidDetails extends AppCompatActivity {

    String aidList[] = {
            "Before providing care, put on protecting gloves or use a barrier between you and the victim to reduce" +
                    "the chance of disease transmission while assisting the injured person.  " +
                    "Clean your hands thoroughly with soap and water when finished.\n\n" +
                    "1. CALL 911 for medical assistance.\n" +
                    "2. Keep victim lying down.\n" +
                    "3. Apply direct pressure using a clean cloth or sterile dressing directly on the wound.\n" +
                    "4. DO NOT take out any object that is lodged in a wound; see a doctor for help in removal\n" +
                    "5. If there are no signs of a fracture in the injured area, carefully elevate the wound above the victim's heart.\n\n" +
                    "Once bleeding is controlled, keep victim warm by covering with a blanket, continuing to monitor for shock.\n",

            "1. Wash your hands and cleanse the injured area with clean soap and water, then blot dry.\n" +
                    "2. Apply antibiotic ointment to minor wound and cover with a sterile gauze dressing or bandage that is slightly larger than the actual wound.\n",

            "1. If an object is impaled in the eye, CALL 911 and DO NOT remove the object.\n" +
                    "2. Cover both eyes with sterile dressings or eye cups to immobilize.\n" +
                    "3. Covering both eyes will minimize the movement of the injured eye.\n" +
                    "4. DO NOT rub or apply pressure, ice, or raw meat to the injured eye.\n" +
                    "5. If the injury is a black eye, you may apply ice to cheek and area around eye, but not directly on the eyeball itself.",

            "First Degree Burn: Skin will appear red and may be swollen or painful. Generally does not require medical attention.\n" +
                    "\n" +
                    "Second Degree Burn: Skin will appear red, blistered and swollen. May require medical attention.\n" +
                    "\n" +
                    "Third Degree Burn: Skin will be visibly charred and may be white. Usually very painful. REQUIRES MEDICAL ATTENTION.\n" +
                    "\n" +
                    "Basic first aid treatment for 1st degree & some 2nd degree burns:\n" +
                    "\n" +
                    "Submerge burn area immediately in cool water until pain stops. " +
                    "If affected area is large, cover with cool wet cloths. Do not break blisters if they are present. " +
                    "If pain persists but no medical assistance is needed, apply medicated first aid cream or gel and cover with sterile dressing." +
                    " If medical attention is needed, do not apply any cream." +
                    " Just cover with a dry, sterile dressing and seek medical help immediately. " +
                    "basic first aid treatment for 3rd degree & some 2nd degree burns: CALL 911!! " +
                    "Third degree burns MUST RECEIVE MEDICAL ATTENTION IMMEDIATELY! DO NOT try to remove any clothing stuck to the burned area. " +
                    "Cover with sterile dressing or clean sheet. DO NOT apply any creams or gels.",

            "1. Flush the affected area with cool running water for at least 15 minutes.\n" +
                    "2. Remove all clothing and jewelry that has been contaminated.\n" +
                    "3. Monitor victim for shock and seek medical assistance.\n" +
                    "4. If chemical burn is in the eyes, flush continuously with water and seek medical attention immediately.",

            "1. Avoid any further exposure to direct sunlight.\n" +
                    "2. Drink plenty of water to prevent dehydration.\n" +
                    "3. Do not apply cold water or ice to a severe burn.\n" +
                    "4. Use over-the-counter remedies to remove discomfort.\n" +
                    "5. If burn is severe and blisters develop, seek medical attention.",

            "1. Do not leave an unconscious victim alone except to call 911 for medical help.\n" +
                    "2. Assess victim’s state of awareness by asking if they are OK.\n" +
                    "3. Check the victim’s Airway, Breathing, and Circulation (ABC’s).\n" +
                    "4. If the victim’s ABC’s are not present, perform CPR. IMPORTANT: only a trained & qualified person should administer CPR.\n" +
                    "5. If ABC’s are present and spinal injury is not suspected, place victim on their side with their chin toward the ground to allow for secretion drainage.\n" +
                    "6. Cover the victim with blanket to keep warm and prevent shock. If victim communicates feeling warm, remove blanket.",

            "1. Ask the victim, \"Are you OK?\"\n" +
                    "2. do not interfere or give first aid if the victim can speak, breathe, or cough.\n" +
                    "3. If the victim cannot speak, breathe, or cough, ask for someone to call 911 and then perform the Heimlich maneuver (abdominal thrust).\n" +
                    "4. How to perform the Heimlich maneuver: Position yourself behind the victim with your arms around victim’s stomach. " +
                    "Place the thumb-side of your fist above the victim’s navel and below the lower end of the breastbone. " +
                    "Take hold of your fist with your free hand and pull fist upward and in, quickly and firmly. " +
                    "Continue with thrusts until the object is dislodged or airway is clear.\n",

            "1. Place infant face down on your forearm supporting the head and neck with your hand. Rest your hand on your knee with the infant’s head lower than it’s body.\n" +
                    "2. With the heel of your hand give four blows between the infant’s shoulder blades.\n" +
                    "3. Turn infant over, place two fingers on the center of the infant’s chest (just below the nipples) and perform up to five chest thrusts.\n" +
                    "4. Repeat until obstruction is clear.\n" +
                    "5. seek medical attention after any choking incident, since complications may arise.",

            "1. Call your local Poison Control Center or 911 for immediate medical attention.\n" +
                    "2. Antidotes on labels may be wrong!! do not follow them unless instructed by a physician.\n" +
                    "3. never give anything by mouth (milk, water, Ipecac, etc.) until you have consulted with a medical professional.\n" +
                    "4. Keep a one ounce bottle of Ipecac on hand at all times in case of an emergency, and give only when instructed by a physician.\n" +
                    "5. If the poison is on the skin, flush skin with water for 15 minutes, then wash and rinse with soap and water.\n" +
                    "6. If poison is in the eye, flush with lukewarm water for 15 minutes. Adults can stand under the shower with eyes open. always consult medical professionals after any eye injury has occurred.\n",

            "1. Control any bleeding by applying direct pressure or with elevation.To avoid risk of infection, do not close wound.\n" +
                    "2. Rinse the bite thoroughly, holding it under running water. Cleanse with soap and water and hold under water again for five minutes.\n" +
                    "3.do not put ointments or medicines on wound. Cover with dry sterile bandage or gauze.\n" +
                    "4. seek medical assistance immediately.\n\n" +
                    "note: report animal and human bites to local police and/or health authorities.\n",

            "1. If possible, remove stinger by scraping it off with a blunt edge (e.g. credit card).\n" +
                    "2. Clean wound and apply cold compress to reduce swelling.\n" +
                    "3. Remove tight clothing and jewelry from areas near the bite in case swelling occurs.\n" +
                    "4. Watch for signs of shock or allergic reaction. Signs include swelling or itching at the wound site, dizziness, nausea or difficulty breathing. Seek medical attention immediately if any of these signs occur.\n" +
                    "5. Continue monitoring victim for shock until medical help arrives.\n" +
                    "6. Check victim’s Airway, Breathing, and Circulation (ABC’s). If ABC’s are impaired then call 911 and begin CPR. IMPORTANT: only a trained & qualified person should administer CPR.\n"
    };

    TextView textView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_aid_details);

        textView = (TextView) findViewById(R.id.details);

        textView.setText(aidList[MainActivity.position]);

    }
}
